<?php

namespace App\Helpers;

class ResponseStatusCodes
{
    const SUCCESS = '200';

    const INVALID_AUTH_CREDENTIAL = '400';

    const NOT_FOUND = '404';
    const CREATED = '201';
    const UNAUTHORIZED = '401';
    const  INTERNAL_SERVER_ERROR = '500';
}
