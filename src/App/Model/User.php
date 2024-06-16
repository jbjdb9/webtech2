<?php

namespace App\App\Model;

class User
{
    private $id;
    private $username;
    private $email;
    private $password;

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

    public function verifyPassword($password)
    {
        error_log('Comparing ' . $password . ' to ' . $this->password);
        return password_verify($password, $this->password);
    }
}