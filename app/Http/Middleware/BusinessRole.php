<?php

namespace App\Http\Middleware;

use App\Helpers\Helper;
use App\Helpers\ResponseMessages;
use App\Helpers\ResponseStatusCodes;
use App\Helpers\ResponseStatuses;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BusinessRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!request()->user() || !$request->user()->isBusiness())
            return Helper::ErrorResponse(ResponseMessages::UNAUTHORIZED, [], ResponseStatusCodes::UNAUTHORIZED);
        return $next($request);
    }
}
