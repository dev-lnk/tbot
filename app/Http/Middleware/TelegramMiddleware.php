<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TelegramMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (app()->isLocal()) {
            return $next($request);
        }

        $telegramIp = [
            '149.154.164.0',
            '149.154.160.0',
            '91.108.8.0',
            '91.108.56.0',
            '91.108.4.0',
            '95.161.64.0',
        ];

        $serverIp = $request->server('REMOTE_ADDR');

        if(!in_array($serverIp, $telegramIp)) {
            return abort(404);
        }

        return $next($request);
    }
}