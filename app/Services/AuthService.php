<?php

namespace App\Services;

use App\Enums\UserRolesEnum;
use App\Exceptions\InvalidRequestException;
use App\Exceptions\ValidationException;
use App\Helpers\Helper;
use App\Helpers\ResponseMessages;
use App\Helpers\ResponseStatusCodes;
use App\Http\Resources\UserDetailsResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthService
{
    // 
    public function signIn(array $credentials): JsonResponse
    {
        try {

            if (!Auth::attempt($credentials)) {
                // log activity
                Helper::LogActivity('invalid_user', 'Failed Login', 'Invalid user login attempt');
                // 
                return Helper::ErrorResponse(ResponseMessages::INVALID_AUTH_CREDENTIAL, [], ResponseStatusCodes::INVALID_AUTH_CREDENTIAL);
            }

            $user = User::where('email', $credentials['email'])->first();
            // $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;
            // log activity
            Helper::LogActivity($user->uuid, 'Successful Login', 'User logged in successfully');
            // 
            return Helper::SuccessResponse(ResponseMessages::LOGIN_SUCCESSFUL, new UserDetailsResource($user), $token, ResponseStatusCodes::SUCCESS);
        } catch (\Throwable $th) {
            logger($th);
            return Helper::ErrorResponse(ResponseMessages::INTERNAL_SERVER_ERROR, [], ResponseStatusCodes::INTERNAL_SERVER_ERROR);
        }
    }


    public function signUp(array $data): JsonResponse
    {
        try {
            DB::beginTransaction();
            $newUser = User::create([
                ...$data,
                'avatar' => 'https://ui-avatars.com//api//?name=Tedbree',
                'role' => UserRolesEnum::BUSINESS,
                'password' => Hash::make($data['password'])
            ]);
            DB::commit();
            return Helper::SuccessResponse(ResponseMessages::USER_CREATED, new UserDetailsResource($newUser), null, ResponseStatusCodes::CREATED);
        } catch (\Throwable $th) {
            //throw $th;
            logger($th);
            DB::rollBack();
            return Helper::ErrorResponse(ResponseMessages::INTERNAL_SERVER_ERROR, [], ResponseStatusCodes::INTERNAL_SERVER_ERROR);
        }
    }
}
