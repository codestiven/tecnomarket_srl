<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Verifica si el usuario está autenticado y es administrador
        if (Auth::check() && Auth::user()->is_admin) {
            return $next($request); // Permite el acceso
        }

        // Si no es administrador, redirige a la página principal
        return redirect('/');
    }
}
