<?php

namespace App\Models;

use PDO;
use Config\Config;

abstract class GeneralModel
{
    protected static ?PDO $_pdo = null;

    public function __construct()
    {
        $this->pdo = self::getPDO();
    }

    private static function getPDO()
    {
        if (is_null(self::$_pdo)) {
            self::$_pdo = new PDO("mysql:host=localhost;dbname=" . Config::getDatabase(), Config::getUser(), Config::getPassword(), [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
            ]);
        }
        return self::$_pdo;
    }
}
