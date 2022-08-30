<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Requests\LoginRequest;
use Auth;

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
        $this->middleware('guest')->except('logout');
    }

    public function login(LoginRequest $request)
{
    // $remember = $request->input('remember');
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password ])) {
        // Success
        $user = Auth::user();
        if(!$user -> is_active) {
            Auth::logout();
            return back() ->withErrors([
                'title' => 'Tài khoản của bạn chưa được active'
            ]);
        }
        $remember = $request->input('remember');
        Auth::login($user,$remember);

        return redirect()->route('admin.dashboard');
    } else {

        return redirect()->back()->withInput()->withErrors(['error' => 'Tài khoản hoặc mật khẩu không đúng']);
    }

}
}
