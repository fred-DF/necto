<?php

## Vendor Bibliotheken initialisieren
require_once __DIR__ . '/vendor/autoload.php';

## Dotenv laden und für laufenden Prozess initialisieren
Dotenv\Dotenv::createImmutable(__DIR__)->load();

if(!getenv('DEBUG')) {
    error_reporting(E_ALL);
} else {
    error_reporting(0);
}

## Laden unterschiedlichster Klassen
require_once 'database.php';