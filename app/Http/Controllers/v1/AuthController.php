<?php

namespace App\Http\Controllers\v1;

use App\Helpers\Helper;
use App\Helpers\ResponseMessages;
use App\Helpers\ResponseStatusCodes;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected AuthService $authServices) {}

    // login 
    public function login(LoginRequest $request): JsonResponse
    {
        return $this->authServices->login($request->validated());
    }

    // 
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return Helper::SuccessResponse(ResponseMessages::LOGOUT_SUCCESSFUL, [], null, ResponseStatusCodes::SUCCESS);
    }
}
