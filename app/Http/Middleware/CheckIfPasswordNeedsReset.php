<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIfPasswordNeedsReset {
    public function handle(Request $request, Closure $next): Response {
        $user = Auth::user();
        if ($user && $user->validado == 0) {
            session(['needs_to_reset_password' => true]);
        }

        return $next($request);
    }
}
