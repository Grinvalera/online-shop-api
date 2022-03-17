<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function getUserById($userId)
    {
        return $this->userService->getUserById($userId);
    }

    public function getAllUsers()
    {
        return $this->userService->getAllUsers();
    }
}
