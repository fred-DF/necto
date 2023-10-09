<?php

require_once __DIR__.'/bootstrap.php';

class database {
    private static function connect (): object|string
    {
        try {
            // Verbindung herstellen
            $conn = new PDO("mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']}", $_ENV['DB_USERNAME'], $_ENV['DB_PASSWORD']);

            // Fehlermodus auf Ausnahmen setzen
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $conn;
        } catch(PDOException $e) {
            if($_ENV['debug']) {
                return "Verbindung fehlgeschlagen: " . $e->getMessage();
            } else {
                return false;
            }
        }
    }

    public static function select ($table, $query): array
    {

        $sql_command = "SELECT ";

        if(isset($query['columns'])) {
            $sql_command = $sql_command."'".$query['columns']."' ";
        } else {
            $sql_command = $sql_command."* ";
        }

        $sql_command = $sql_command."FROM ".$table." ";

        if(isset($query['conditions'])) {
            $zaehler = 0;
            $sql_command = $sql_command." WHERE ";
            foreach ($query['conditions'] as $condition) {
                $zaehler++;

                $sql_command = $sql_command."`".$condition['0']."`='".$condition[1]."' ";
                if($zaehler != count($query['conditions'])) {
                    $sql_command = $sql_command."&& ";
                }
            }
        }

        if(isset($query['condition'])) {
            $sql_command = $sql_command." WHERE ".$query['condition']." ";
        }

        if(isset($query['order'])) {
            $sql_command = $sql_command." ORDER BY '".$query['order']['column']."' ".$query['order']['direction']." ";
        }

        if(isset($query['limit'])) {
            $sql_command = $sql_command."LIMIT ".$query['limit'];
        }

        ## "select * FROM 'table WHERE 'xy'=='xyz' LIMIT 2";

        $pdo = database::connect();
        $stmt = $pdo->prepare($sql_command);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}