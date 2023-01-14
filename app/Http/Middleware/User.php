<?php

namespace App\Http\Middleware;

use Closure;

class User
{
    /**
    * Handle an incoming request.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \Closure  $next
    * @return mixed
    main users of dashbord
    financial_Officer
    sales_manager
    D_Marketing
    D_human_Resources
    D_technical
    */
    public function handle($request, Closure $next)
    {
        if(auth()->user()) {
                return $next($request);
        } else {
            return redirect('/');
        }
    }
}
