<?php

namespace App\App\Model;

use App\App\Database\ORM;
use PDO;
use PDOException;

class User
{
    private $id;
    private $username;
    private $email;
    private $password;
    public $role;

    public function __construct($id, $username, $email, $password, $isHashed = false)
    {
        $this->id = $id;
        $this->username = $username;
        $this->email = $email;
        $this->setPassword($password, $isHashed);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password, $isHashed = false)
    {
        $this->password = $isHashed ? $password : password_hash($password, PASSWORD_DEFAULT);
    }

    public function verifyPassword($password): bool
    {
        return password_verify($password, $this->password);
    }

    public static function getById($id): ?User
    {
        $stmt = ORM::getPdo()->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute(['id' => $id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? new User($user['id'], $user['username'], $user['email'], $user['password'], true) : null;
    }

    public static function getByUsernameOrEmail($usernameOrEmail): ?User
    {
        $stmt = ORM::getPdo()->prepare('SELECT * FROM users WHERE username = :usernameOrEmail OR email = :usernameOrEmail');
        $stmt->execute(['usernameOrEmail' => $usernameOrEmail]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        return $user ? new User($user['id'], $user['username'], $user['email'], $user['password'], true) : null;
    }

    public function create()
    {
        try {
            $stmt = ORM::getPdo()->prepare('INSERT INTO users (username, email, password) VALUES (:username, :email, :password)');
            return $stmt->execute([
                'username' => $this->username,
                'email' => $this->email,
                'password' => $this->password
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function update()
    {
        try {
            $stmt = ORM::getPdo()->prepare('UPDATE users SET username = :username, email = :email, password = :password WHERE id = :id');
            return $stmt->execute([
                'id' => $this->id,
                'username' => $this->username,
                'email' => $this->email,
                'password' => $this->password
            ]);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function delete()
    {
        try {
            $stmt = ORM::getPdo()->prepare('DELETE FROM users WHERE id = :id');
            return $stmt->execute(['id' => $this->id]);
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public static function getAll()
    {
        $stmt = ORM::getPdo()->prepare('SELECT * FROM users');
        $stmt->execute();
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return array_map(function($user) {
            $userInstance = new User($user['id'], $user['username'], $user['email'], $user['password'], true);
            $userInstance->role = UserRole::getRoleNameByUserId($user['id']);
            return $userInstance;
        }, $users);
    }
}