<?php

namespace App\App\Model;
use App\App\Database\ORM;

class User {
    private $id;
    private $username;
    private $email;
    private $password;

    public function login($usernameOrEmail, $password) {
        $user = ORM::getUserByUsernameOrEmail($usernameOrEmail);

        if ($user && password_verify($password, $user->getPassword())) {
            return $user;
        } else {
            return null;
        }
    }
    public function getPassword() {
        return $this->password;
    }
    public function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
    public function getId() {
        return $this->id;
    }
    public function find($id) {
        return ORM::getUserById($id);
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function getUsername() {
        return $this->username;
    }
    public function setUsername($username) {
        $this->username = $username;
    }
    public function getEmail() {
        return $this->email;
    }
    public function setEmail($email) {
        $this->email = $email;
    }
}