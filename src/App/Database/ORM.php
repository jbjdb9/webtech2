<?php

namespace App\App\Database;

use App\App\Model\User;
use PDO;
use PDOException;

class ORM {
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
    public static function saveUser(User $user)
    {
        try {
            $stmt = self::getPdo()->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
            return $stmt->execute([
                'username' => $user->getUsername(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword()
            ]);
        } catch (PDOException $e) {
            // Print PDOException message
            echo $e->getMessage();
            return false;
        }
    }
    public static function getUserByUsernameOrEmail($usernameOrEmail) {
        $stmt = self::getPdo()->prepare('SELECT * FROM users WHERE username = :usernameOrEmail OR email = :usernameOrEmail');
        $stmt->execute(['usernameOrEmail' => $usernameOrEmail]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}