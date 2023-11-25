<?php
require __DIR__.'/../bootstrap.php';

Class AdminController {
    public static function getDayAmount () {
        return database::executeQuery('SELECT SUM(`price_total`) AS amount FROM orders WHERE DATE(`created_at`) = CURDATE()');
    }

    public static function countDispatches () {
        return database::executeQuery('SELECT COUNT(*) FROM orders WHERE shipped = 0');
    }

    public static function getOrdersToDispatch () {
        return database::select('orders', [ 'conditions'=> [['shipped', 0]]]);
    }

    public static function getProducts () {
        return database::select('products', []);
    }

    public static function getProductData ($product_id) {
        return database::select('products', [ 'conditions' => [['ID', $product_id]]]);
    }

    public static function getProductVariants ($product_id) {
        return database::select('product_variants', ['conditions' => [['product_ID', $product_id]]]);
    }
}