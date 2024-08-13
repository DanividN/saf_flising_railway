<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsAdminOrCall
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response {
        if (auth()->user()->tipo_usuario === User::ADMINISTRATIVO || auth()->user()->tipo_usuario === User::CALLCENTER) {
            return $next($request);
        }

        return redirect()->route('pwa.clientes');
    }
}
