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
}