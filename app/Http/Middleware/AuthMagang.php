<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthMagang
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (empty(session('magang.id'))) {
            return view('login.magang');
        }
        return $next($request);
    }
}
