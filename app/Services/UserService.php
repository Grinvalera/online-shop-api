<?php

namespace App\Services;

use App\Models\User;

class UserService
{
    public function getUserById($id)
    {
        return User::where('id', $id)->with('profile')->first();
    }

    public function getAllUsers()
    {
        return User::with('profile')->get();
    }
}
