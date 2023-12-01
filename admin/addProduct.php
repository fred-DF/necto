<?php

//if(isset($_GET['token'])) {
//
//} else {
//        header("HTTP/1.1 403");
//        header("Location: login.html");
//        exit();
}
require_once __DIR__.'/../bootstrap.php';
require_once __DIR__.'/AdminController.php';

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo $_ENV['URL']; ?>/admin/style.css">
    <link rel="stylesheet" href="<?php echo $_ENV['URL']; ?>/admin/products.css">
    <meta name="theme-color" content="#fcfcfc">
    <title>Necto Clothing - Add Product</title>
</head>
<body>
<div class="widget-wrapper" style="max-width: 330px">
    <h1>Add product</h1>
    <p>Some fields can't be edited later, so fill all gaps carefully.</p>
    <input type="text" placeholder="name" id="name">
    <input type="tel" placeholder="price" id="price">
    <span>
    <input type="file" id="preview-picture" accept="image/jpeg"><br>
    <span class="info">Choose one preview image for the </span>
    </span>

    <h3>Variants</h3>
    <p>This section isn't editable. After saving its impossible to remove or add variants, but you can set the stock amount.</p>

    <span id="variants">
    </span>
    <a class="add" onclick="addVariant()">+ add another variant</a>
    <button onclick="save()">save</button>
</div>
<script>
    /*if(localStorage.getItem('dispatching-tutorial') !== null) {
        document.getElementById('dispatch-tutorial').shown = 'false';
    } else {
        localStorage.setItem('dispatching-tutorial', 'true');
    }*/

    let variants = [];

    function deleteVariant (id)
    {
        document.getElementById(id + '_variant_wrapper').remove();
    }

    function addVariant ()
    {
        let counter = variants.length;

        const div = document.createElement('div');
        div.classList.add('variant-box');
        div.id = counter + "_variant_wrapper";

        const size_inpt = document.createElement('input');
        size_inpt.type = "text";
        size_inpt.id = counter + "_size";
        size_inpt.placeholder = "size";

        const color_text_inpt = document.createElement('input');
        color_text_inpt.type = "text";
        color_text_inpt.placeholder = "color (word)"
        color_text_inpt.id = counter + "_color_text";

        const color_inpt = document.createElement('input');
        color_inpt.type = "color";
        color_inpt.id = counter + "_color";

        const color_span = document.createElement('span');
        color_span.innerText = "Pic a color that matches the color of the product";
        color_span.classList.add('info');

        const image_inpt = document.createElement('input');
        image_inpt.type = "file";
        image_inpt.accept = "image/jpeg";
        image_inpt.id = counter + "_image";

        const image_span = document.createElement('span');
        image_span.innerText = "Upload an image of the product in the specific color";
        image_span.classList.add('info');

        const del_a = document.createElement('a');
        del_a.classList.add('delete');
        del_a.innerText = "- delete";
        del_a.onclick = () => { deleteVariant(counter) };

        div.appendChild(size_inpt);
        div.appendChild(color_text_inpt);
        div.appendChild(color_inpt);
        div.appendChild(color_span);
        div.appendChild(image_inpt);
        div.appendChild(image_span);
        div.appendChild(del_a);

        document.getElementById('variants').appendChild(div);

        variants.push({
            id: counter
        });

    }

    addVariant()

    function save ()
    {

        const data = [];

        let formData = new FormData();
        formData.append("route", "createProduct");
        formData.append("preview_image", document.getElementById('preview-picture').files[0]);

        variants.forEach((variant) => {
            const variant_data = {
                ID: variant.id,
                size: document.getElementById(variant.id + "_size").value,
                color: document.getElementById(variant.id + "_color_text").value,
                color_hex: document.getElementById(variant.id + "_color").value
            }

            formData.append(variant.id + "_image", document.getElementById(variant.id + "_image").files[0]);

            data.push(variant_data);
        });

        const complete_data = {
            name: document.getElementById('name').value,
            price: document.getElementById('price').value,
            variants: data
        }

        formData.append("data", JSON.stringify(complete_data));

        console.log();
        const xhr = new XMLHttpRequest();
        xhr.open("POST", "/api/api.php", true);
        xhr.onload = () => {
            if(xhr.status === 200) {
                // window.location = "../admin";
            } else {
                alert("Fehler aufgetreten");
            }
        };

        xhr.send(formData);

    }

</script>
</body>
</html>
