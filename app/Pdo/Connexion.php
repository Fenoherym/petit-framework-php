<?php

namespace App\Pdo;

use PDO;

class Connexion
{
    private static PDO $pdo;
    public function __construct()
    {
        try {
            static::$pdo = new PDO("mysql:host=localhost;dbname=cours", 'root', '', [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getPDO()
    {
        return static::$pdo;
    }
}
