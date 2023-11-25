<?php

require_once '../bootstrap.php';
require_once '../vendor/autoload.php';

Class Images {
    public static function store ($img) {
        $uploaddir = '/var/www/uploads/'; // Pfad, wo das Bild gespeichert werden soll
        $uploadfile = $uploaddir . basename($_FILES['datei']['name']);

        if (move_uploaded_file($_FILES['datei']['tmp_name'], $uploadfile)) {
            echo "Datei ist valide und wurde erfolgreich hochgeladen.\n";
        } else {
            echo "Möglicherweise eine Dateiupload-Attacke!\n";
        }
    }
}