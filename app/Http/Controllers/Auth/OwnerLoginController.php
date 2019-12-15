<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class OwnerLoginController extends Controller
{
    /**
     * Show the application’s login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view(’auth.admin-login’);
    }
    protected function guard(){
        return Auth::guard('owner');
    }

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

    public function login(Request $request)
    {
        if (Auth::guard('owner')->attempt(['email' => $request->email, 'password_wisatawan' => $request->password ])) {
            return redirect()->intended('/');
        }
    }
    public function __construct()
    {
        $this->middleware('guest:owner')->except('logout');
    }
}
