<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Session\Store;

class SessionTimeout {

    protected $session;
    protected $timeout;

    public function __construct(Store $session,Store $timeout){
        $this->session = $session;
        $this->timeout = GetSettings()->session_timeout;

    }
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Check If user Login

        $isLoggedIn = $request->path() != AdminPath().'/logout';

        if(! session('lastActivityTime')) {
            $this->session->put('lastActivityTime', time());
        }

        elseif(time() - $this->session->get('lastActivityTime') > $this->timeout){
            $this->session->forget('lastActivityTime');
            $email = $request->user()->email;
            auth()->logout();
            return redirect('/');
        }

        $isLoggedIn ? $this->session->put('lastActivityTime', time()) : $this->session->forget('lastActivityTime');
        return $next($request);
    }

}