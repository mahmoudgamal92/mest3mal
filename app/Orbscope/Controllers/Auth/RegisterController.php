<?php

namespace App\Orbscope\Controllers\Auth;

use App\Notifications\EassalNotfication;
use App\Orbscope\Models\Department;
use App\User;
use Notification;
use App\Orbscope\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Orbscope\Controllers\UploadFiles as Upload;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        $departs = Department::where('status', 'active')->OrderBy('id', 'Asc')->get();

        return view('auth.register', compact('departs'));
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => 'required|string|max:180|unique:users',
            'phone' => 'required|max:15|min:6',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        //Notification::route('mail', $data['email'])->notify(new EassalNotfication());
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
            'type' => 'user',
            'api_token' => Str::random(60),
        ]);
    }
}
