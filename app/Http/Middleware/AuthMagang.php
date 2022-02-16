<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;


class AuthMagang
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (empty(session('magang.id'))){
            return redirect(route('magang.login'));
        }

        return $next($request);
    }
}
