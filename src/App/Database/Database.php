<?php

namespace App\App\Database;

use PDO;

class Database {
    private static $pdo;

    public static function init() {
        $config = require __DIR__ . '/../../../config/database.php';
        self::$pdo = new PDO($config['database']);
        self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getPdo() {
        if (!self::$pdo) {
            self::init();
        }
        return self::$pdo;
    }
}