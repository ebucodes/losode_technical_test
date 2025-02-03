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
}
