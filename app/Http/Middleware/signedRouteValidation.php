<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class signedRouteValidation
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
        if(!$request->hasValidSignature()){
            return redirect('/admin/');
        }
        return $next($request);
    }
}
