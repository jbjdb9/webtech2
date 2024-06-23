<?php

namespace App\App\Model;

use App\App\Database\ORM;

class UserRole {
    private $userId;
    private $roleId;

    public static function getRoleNameByUserId($userId)
    {
        $pdo = ORM::getPdo();
        $stmt = $pdo->prepare('SELECT role_id FROM user_roles WHERE user_id = :id');
        $stmt->execute(['id' => $userId]);
        $roleId = $stmt->fetchColumn();

        if (!$roleId) {
            return null;
        }

        $stmt = $pdo->prepare('SELECT name FROM roles WHERE id = :id');
        $stmt->execute(['id' => $roleId]);
        return $stmt->fetchColumn();
    }

    public static function assignRole($userId, $roleId)
    {
        $pdo = ORM::getPdo();
        $stmt = $pdo->prepare('INSERT INTO user_roles (user_id, role_id) VALUES (:user_id, :role_id)');
        $stmt->execute(['user_id' => $userId, 'role_id' => $roleId]);
    }

    public static function revokeRole($userId, $roleId)
    {
        $pdo = ORM::getPdo();
        $stmt = $pdo->prepare('DELETE FROM user_roles WHERE user_id = :user_id AND role_id = :role_id');
        $stmt->execute(['user_id' => $userId, 'role_id' => $roleId]);
    }
}