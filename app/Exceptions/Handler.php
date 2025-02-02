<?php

use App\Exceptions\InvalidRequestException;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;

class Handler extends ExceptionHandler
{
    public function render($request, Throwable $exception)
    {
        // Handle API routes
        if ($request->is('api/*')) {
            // Handle validation exceptions (e.g., duplicate email)
            if ($exception instanceof ValidationException) {
                return response()->json([
                    'message' => 'Validation failed',
                    'errors' => $exception->errors(),
                ], 422);
            }

            // Handle custom exceptions
            if ($exception instanceof InvalidRequestException) {
                return $exception->render($request);
            }

            // Default error response for API
            return response()->json([
                'message' => $exception->getMessage(),
            ], 500);
        }

        return parent::render($request, $exception);
    }
}
