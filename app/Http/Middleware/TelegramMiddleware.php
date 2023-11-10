<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
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
            '91.108.6.67',
        ];

        $serverIp = $request->ip();

        if(!in_array($serverIp, $telegramIp)) {
            throw new Exception('wrong ip: '. $serverIp);
        }

        return $next($request);
    }
}