<?php

namespace App\Services;

use App\Helpers\Helper;
use App\Helpers\ResponseMessages;
use App\Helpers\ResponseStatusCodes;
use App\Http\Resources\UserDetailsResource;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Request;

class UserService
{
    // 
    public function fetchAllUsers(): JsonResponse
    {
        try {
            $users = User::all();

            // log activity
            Helper::LogActivity('invalid_user', 'Failed Login', 'Invalid user login attempt');
            return Helper::SuccessResponse(ResponseMessages::ACTION_SUCCESSFUL, UserDetailsResource::collection($users), null, ResponseStatusCodes::SUCCESS);
        } catch (\Throwable $th) {
            logger($th);
            return Helper::ErrorResponse(ResponseMessages::INTERNAL_SERVER_ERROR, [], ResponseStatusCodes::INTERNAL_SERVER_ERROR);
        }
    }

    // 
    public function fetchUser(Request $request): JsonResponse
    {
        try {
            $userId = $request->input('userId');
            $user = User::where('uuid', $userId)->first();
            // 
            if (empty($userId)) {

                return Helper::ErrorResponse(ResponseMessages::USER_NOT_FOUND, [], ResponseStatusCodes::NOT_FOUND);
            }
            // 
            if (!$user) {
                return Helper::ErrorResponse(ResponseMessages::USER_NOT_FOUND, [], ResponseStatusCodes::NOT_FOUND);
            }

            return Helper::SuccessResponse(ResponseMessages::ACTION_SUCCESSFUL, new UserDetailsResource($user), null, ResponseStatusCodes::SUCCESS);
        } catch (\Throwable $th) {
            logger($th);
            return Helper::ErrorResponse(ResponseMessages::INTERNAL_SERVER_ERROR, [], ResponseStatusCodes::INTERNAL_SERVER_ERROR);
        }
    }
}
