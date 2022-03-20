<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Auth;

class CustomAuth
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
        $path = $request->path();

        if ($path == "login" && isset(Auth::user()->id)) {
            return redirect('/appointments');
        }
        elseif($path != "login" && !isset(Auth::user()->id)){
            return redirect('/login');
        }

        return $next($request);
    }
}
