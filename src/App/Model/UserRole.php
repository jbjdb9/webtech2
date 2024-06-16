<?php

namespace App\App\Model;

use App\App\Database\ORM;

class UserRole {
    private $userId;
    private $roleId;

    public function getUserId() {
        return $this->userId;
    }
    public function setUserId($userId) {
        $this->userId = $userId;
    }
    public function getRoleId() {
        return $this->roleId;
    }
    public function setRoleId($roleId) {
        $this->roleId = $roleId;
    }

    public static function getRoleNameByUserId($userId)
    {
        // Get the PDO instance
        $pdo = ORM::getPdo();

        // Prepare and execute the query to get the role ID from the UserRole table
        $stmt = $pdo->prepare('SELECT role_id FROM user_roles WHERE user_id = :id');
        $stmt->execute(['id' => $userId]);
        $roleId = $stmt->fetchColumn();

        // If no role ID was found, return null
        if (!$roleId) {
            return null;
        }

        // Prepare and execute the query to get the role name from the Role table
        $stmt = $pdo->prepare('SELECT name FROM roles WHERE id = :id');
        $stmt->execute(['id' => $roleId]);
        // Return the role name
        return $stmt->fetchColumn();
    }
}