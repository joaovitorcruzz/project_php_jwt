<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Amnésia na hora de desenvolver, esquecimento dos commits granulares, vou comentando inicio e fim
        // Inicio Implementando validação se permissão é igual a admin ou não
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request);
        }
        // Final Implementando validação se permissão é igual a admin ou não
        return response()->json(['error' => 'Acesso não autorizado.'], 403);
    }
}
