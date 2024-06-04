<?php

namespace App\Http\Middleware;

use Closure;

class OnlyAjaxMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!$request->ajax()) {
            abort(403, 'Coś się stało!');
        }

        return $next($request);
    }
}