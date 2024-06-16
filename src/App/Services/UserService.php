<?php

namespace App\App\Services;

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

//TODO: figure out what to do with this