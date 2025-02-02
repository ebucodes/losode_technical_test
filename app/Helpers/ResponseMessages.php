<?php

namespace App\Helpers;

class ResponseMessages
{
    const ACTION_SUCCESSFUL = 'Successful';
    const ACTION_FAILED = 'Action failed';
    const LOGIN_SUCCESSFUL = 'Login successful';
    const LOGOUT_SUCCESSFUL = 'Successful logged out user';

    const USER_CREATED = 'User Created Successfully!';
    const LOGIN_FAILED = 'Login failed';

    const USER_NOT_FOUND = 'User not found';

    const USER_REQUIRED = 'User ID is missing';

    const INVALID_AUTH_CREDENTIAL = 'Invalid login credentials';
    const UNAUTHORIZED = 'This user is not authorized to access this page';
    const INTERNAL_SERVER_ERROR = 'Internal server error';
}
