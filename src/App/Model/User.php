<?php

namespace App\App\Model;
use App\App\Database\ORM;

class User {
    private $id;
    private $username;
    private $email;
    private $password; // This will store the hashed password

    public function login($usernameOrEmail, $password) {
        // Retrieve the user from the database using the ORM
        $user = ORM::getUserByUsernameOrEmail($usernameOrEmail);

        if ($user && password_verify($password, $user->getPassword())) {
            // Password is valid, return the user
            return $user;
        } else {
            // Invalid credentials
            return null;
        }
    }
    public function setPassword($password) {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
    public function getId() {
        return $this->id;
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