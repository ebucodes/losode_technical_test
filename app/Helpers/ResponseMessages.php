<?php

namespace App\Helpers;

class ResponseMessages
{
    const ACTION_SUCCESSFUL = 'Successful';
    const ACTION_FAILED = 'Action failed';
    const LOGIN_SUCCESSFUL = 'Login successful';
    const LOGOUT_SUCCESSFUL = 'Successful logged out user';

    const USER_CREATED = 'User Created Successfully!';
    const JOB_CREATED = 'Job Successfully Created!';

    const APPLICATION_SUBMITTED = 'Application Submitted Successfully!';

    const JOB_UPDATED = 'Job Successfully Updated!';
    const JOB_DELETED = 'Job Successfully Deleted!';

    const LOGIN_FAILED = 'Login failed';

    const USER_NOT_FOUND = 'User not found';
    const NO_RECORDS_FOUND = 'No records found';
    const USER_REQUIRED = 'User ID is missing';

    const INVALID_AUTH_CREDENTIAL = 'Invalid login credentials';
    const UNAUTHORIZED = 'This user is not authorized to access this page';
    const INTERNAL_SERVER_ERROR = 'Internal server error';
}
