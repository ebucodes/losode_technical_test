<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function __construct(protected UserService $userServices) {}

    // get all users 
    public function getAllUsers(): JsonResponse
    {
        return $this->userServices->fetchAllUsers();
    }
}
