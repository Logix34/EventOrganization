<?php

namespace App\Http\Middleware;

use Closure;

class EventAdmin
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
        if(\Auth::check() && \Auth::user()->user_type==1){
            return $next($request);
        }else{
            \Session::flash("error","Please login to access this area");
            return redirect()->to('/admin/participants');
        }

    }
}
