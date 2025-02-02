<?php

namespace App\Exceptions;

use App\Helpers\Helper;
use App\Helpers\ResponseStatusCodes;

class InvalidRequestException extends MasterException
{
    public function render($request)
    {
        return Helper::ErrorResponse($this->getMessage(), [], ResponseStatusCodes::INVALID_REQUEST);
    }
}
