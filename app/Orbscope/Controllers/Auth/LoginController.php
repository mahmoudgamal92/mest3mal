<?php

namespace App\Orbscope\Controllers\Auth;

use App\Orbscope\Controllers\Controller;
use App\Orbscope\Models\Department;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        $departs=Department::where('status','active')->OrderBy('id','Asc')->get();
        //dd(url()->previous(),'dd');
        session(['link' => url()->previous()]);
        return view('auth.login', compact('departs'));
    }

    protected function authenticated(Request $request, $user)
    {
        session(['link' => url()->previous()]);
        return redirect(session('link'));
    }


    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->to('/login')
            ->withInput()->withErrors(['msg'=>trans('auth.failed')]);
    }
}
