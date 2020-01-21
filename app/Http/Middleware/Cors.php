<?php

namespace App\Http\Middleware;

use Closure;

class Cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //domains to accept requests from
        $domains = ['http://etenderadmin.talanku.com'];
        //if a request is made
        if (isset($request->server()['HTTP_ORIGIN'])){
            $origin = $request->server()['HTTP_ORIGIN'];
            //use the needle in the haystack to check if the accepted array is in there
            if(in_array($origin,$domains)){
                header('Access-Control-Allow-Origin: ' . $origin);
                header('Access-Control-Allow-Headers: Origin, Content-Type, Authorization');
            }
        }
        
        return $next($request);
    }
}
