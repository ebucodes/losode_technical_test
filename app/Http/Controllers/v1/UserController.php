<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function __construct(protected UserService $userService) {}

    // get all users 
    public function getAllUsers(): JsonResponse
    {
        return $this->userService->fetchAllUsers();
    }

    // get single user
    public function getUser(Request $request): JsonResponse
    {
        $userId = $request->input('userId');
        logger('USER ID: ' . $userId);
        return $this->userService->fetchUser($userId);
    }
}
