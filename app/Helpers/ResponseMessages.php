<?php

namespace App\Helpers;

class ResponseMessages
{
    const ACTION_SUCCESSFUL = 'Action successful';
    const ACTION_FAILED = 'Action failed';
    const LOGIN_SUCCESSFUL = 'Login successful';

    const LOGIN_FAILED = 'Login failed';



    const INVALID_AUTH_CREDENTIAL = 'Invalid login credentials';
    const UNAUTHORIZED = 'This user is not authorized to access this page';
    const INTERNAL_SERVER_ERROR = 'Internal server error';
}