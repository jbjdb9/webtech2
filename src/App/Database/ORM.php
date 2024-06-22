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
    public static function getUserById($id) {
        $stmt = self::getPdo()->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public static function getUserByUsernameOrEmail($usernameOrEmail) {
        $stmt = self::getPdo()->prepare('SELECT * FROM users WHERE username = :usernameOrEmail OR email = :usernameOrEmail');
        $stmt->execute(['usernameOrEmail' => $usernameOrEmail]);
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        if ($user) {
            return new User($user->id, $user->username, $user->email, $user->password, true);
        }
        return null;
    }
    public static function createUser(User $user)
    {
        try {
            $stmt = self::getPdo()->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
            return $stmt->execute([
                'username' => $user->getUsername(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword()
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public static function updateUser(User $user)
    {
        try {
            $stmt = self::getPdo()->prepare('UPDATE users SET username = :username, email = :email, password = :password WHERE id = :id');
            return $stmt->execute([
                'id' => $user->getId(),
                'username' => $user->getUsername(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword()
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public static function deleteUser(User $user)
    {
        try {
            $stmt = self::getPdo()->prepare('DELETE FROM users WHERE id = :id');
            return $stmt->execute(['id' => $user->getId()]);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function getAllUsers() {
        $stmt = self::getPdo()->prepare('SELECT * FROM users');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}