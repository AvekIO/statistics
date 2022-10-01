<?php
declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CacheResponse
{
    private const CACHE_TTL = 60;

    public function handle(Request $request, Closure $next)
    {
        return cache()->remember($request->fullUrl(), self::CACHE_TTL, fn () => $next($request));
    }
}
