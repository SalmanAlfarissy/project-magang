<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthAdmin
{
    public function handle(Request $request, Closure $next, ...$guards)
    {
        if (empty(session('admin.id'))) {
            return view('login.admin');
        }
        return $next($request);
    }
}
