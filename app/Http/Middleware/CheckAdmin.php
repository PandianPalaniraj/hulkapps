<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\models\Roles;

class CheckAdmin
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
        $user_role = Roles::where('id', Auth::user()->role_id)->value('role');
        if ($user_role == 'Admin') {
            return $next($request);
        }
        else{
            return back()->with('error', 'You are not authorized to access that page!');
        }

    }
}
