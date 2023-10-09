<?php

require_once '../database.php';

class product
{
    public static function getInfo ($id) {
        // Abfrage bei der Datenbank
        $info = database::select('products', ['conditions' => [['ID', $id]]]);
        return $info;
    }
}
