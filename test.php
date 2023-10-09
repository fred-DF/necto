<?php

require_once 'bootstrap.php';

echo database::select('products', ['conditions' => [["product_price", "35"]]]);