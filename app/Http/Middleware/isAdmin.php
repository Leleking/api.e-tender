<?php

namespace App\Http\Middleware;


use Illuminate\Support\Facades\Auth;
use App\User;
use Closure;

class isAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Rquest $request, Closure $next)
    {
        if($request::user()->isAdmin()){
            return $next($request);
        }
        return redirect('/');
    }
}
