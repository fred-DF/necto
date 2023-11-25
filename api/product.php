<?php

require_once '../database.php';

class product
{
    public static function getInfo ($id) {
        // Abfrage bei der Datenbank
        $info = database::select('products', ['conditions' => [['ID', $id]]]);
        return $info;
    }

    public static function createProduct ($data)
    {
        $data = json_decode($data, 1);
        $colors = ['colors' => []];
        $sizes = ['sizes' => []];
//        var_dump($data);

        $variants = $data['variants'];

        foreach ($variants as $variant) {
            if(!in_array($variant['color'], $colors['colors'])) {
                $colors['colors'][] = $variant['color'];
            }
            if(!in_array($variant['size'], $sizes['sizes'])) {
                $sizes['sizes'][] = $variant['size'];
            }
        }

        $path = '/src/product_images/'.uniqid().$_FILES['preview_image']['name'];
        if (!move_uploaded_file($_FILES['preview_image']['tmp_name'], __DIR__.'/..'.$path)) {
            error_log("Die Datei konnte nicht gespeichert werden! - Line: 33");
            header("HTTP/1.1 400");
            exit();
        }

        $stripe = new \Stripe\StripeClient($_ENV['STRIPE_API_KEY']);

        $price_object = $stripe->prices->create([
            'unit_amount' => $data['price'] * 100,
            'currency' => 'bgr',
            'recurring' => ['interval' => 'month'],
            'product_data' => [
                'name' => 'Gold Special',
                'images' => [$_ENV['URL'].$path],
            ],
        ]);

        $query = "INSERT INTO `products`(`product_name`, `product_price`, `product_sizes`, `product_colors`, `product_pic_url`, `stripe_price_id`) VALUES ('".$data['name']."','".$data['price']."','".addslashes(json_encode($sizes))."','".addslashes(json_encode($colors))."','".$_ENV['URL'].$path."',$price_object->id])";

        $response = database::executeQuery($query);

        $data = database::select('products', ['conditions' => [['product_name', $data['name']]], 'order' => ['column' => '`products`.`ID`', 'direction' => 'DESC']]);
        $ID = $data[0]['ID'];

        var_dump($_FILES);
        foreach ($variants as $variant) {
            $path = '/src/product_images/'.uniqid().$_FILES[$variant['ID'].'_image']['name'];
            if (move_uploaded_file($_FILES[$variant['ID'].'_image']['tmp_name'], __DIR__.'/..'.$path)) {
                database::executeQuery("INSERT INTO `product_variants`(`product_ID`, `product_color`, `product_size`, `product_pic_url`, `stock`) VALUES ('".$ID."','".$variant['color']."','".$variant['size']."','".$_ENV['URL'].$path."','0')");
            } else {
                error_log("[PRODUCT.PHP] Tried to save uploaded image into path - failed | product.php line 43");
            }
        }
    }
}
