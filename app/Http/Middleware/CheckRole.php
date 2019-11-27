<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;

use Closure;

class CheckRole
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
        
        if(Auth::user()->rol != 2)
        {
            Auth::logout();
            $toastr = ['toastr' => 'error', 'msg' => 'No tiene el rol apropiado para acceder!'];
            return redirect()->route('login')->with($toastr);
        }

        return $next($request);
        
    }
}
