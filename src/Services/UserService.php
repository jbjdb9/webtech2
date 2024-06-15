<?php

namespace App\Services;

class UserService
{
    public function getUser($id)
    {
        // For now returns dummy user data
        return [
            'id' => $id,
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
        ];
    }
}