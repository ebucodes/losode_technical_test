<?php

namespace App\Exceptions;

use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use Throwable;

class MasterException extends Exception
{
    private string $level = "debug";

    private array $logContext;

    public function __construct($message = "", $code = 0,  $context = [], Throwable $previous = null)
    {
        $this->logContext = array_merge([
            'class' => static::class,
            'file' => $this->getFile(),
            'line' => $this->getLine(),
        ], $context);

        if ($message instanceof Exception) {
            parent::__construct($message->getMessage(), $message->getCode(), $message->getPrevious());
        } else {
            parent::__construct($message, $code, $previous);
        }
    }

    public function context(): array
    {
        return $this->logContext;
    }
}
