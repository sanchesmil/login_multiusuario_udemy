<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {  // verifica se o usuário já está autenticado

            if($guard == 'admin'){          // Caso esteja autenticado como 'admin', redireciona p/ a página de dashboard de 'admin'
                return redirect()->route('admin.dashboard');
            }
            return redirect('/home');       // Senão, redireciona p/ página Home de usuário comum
        }

        return $next($request);             // Caso não esteja autenticado, prossegue a requisição
    }
}
