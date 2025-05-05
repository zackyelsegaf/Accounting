<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Session;
use Auth;
use DB;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except([
            'logout',
            'locked',
            'unlock'
        ]);
    }

    public function login()
    {
        return view('auth.login');
    }

    /** LogIn */
    public function authenticate(Request $request)
    {
        $request->validate([
            'email'    => 'required|string|email',
            'password' => 'required|string',
        ]);

        $email    = $request->email;
        $password = $request->password;

        if (Auth::attempt(['email'=>$email,'password'=>$password,'status'=>'Active'])) {
            sweetalert()->success('Login successfully :)');
            return redirect()->intended('home');
        } elseif (Auth::attempt(['email'=>$email,'password'=>$password,'status'=> null])) {
            sweetalert()->success('Login successfully :)');
            return redirect()->intended('home');
        } else {
            sweetalert()->error('Wrong Username or Password');
            return redirect('login');
        }
    }

    /** Log Oout */
    public function logout()
    {
        Auth::logout();
        sweetalert()->success('Logout successfully :)');
        return redirect('login');
    }

}
