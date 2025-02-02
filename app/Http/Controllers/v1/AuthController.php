<?php

namespace App\Http\Controllers\v1;

use App\Helpers\Helper;
use App\Helpers\ResponseMessages;
use App\Helpers\ResponseStatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authServices) {}

    // login 
    public function login(LoginRequest $request): JsonResponse
    {
        return $this->authServices->signIn($request->validated());
    }

    // register 
    public function register(RegisterRequest $request): JsonResponse
    {
        return $this->authServices->signUp($request->validated());
    }

    // 
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return Helper::SuccessResponse(ResponseMessages::LOGOUT_SUCCESSFUL, [], null, ResponseStatusCodes::SUCCESS);
    }
}
