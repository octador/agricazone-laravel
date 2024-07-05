<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfNotCustomerOrFarmer
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
        // Redirection en fonction du role_id si l'utilisateur n'a pas de rôle
        if (!$request->user()) {
            return redirect('/welcome')->with('error', 'Unauthorized access.');
        }

        switch ($request->user()->role_id) {
            case 2:
                return redirect()->route('dashboardFarmer');
            case 3:
                return redirect()->route('dashboardClient');
            default:
                return redirect('/welcome')->with('error', 'Unauthorized access.');
        }
    }
}
