<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use DB;
use App\Models\User;
use App\Models\Password_resets;
use Carbon\Carbon;
use Mail;
use Hash;
// use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    // use SendsPasswordResetEmails;
    public function index()
    {
        return view('auth.passwords.email');
    }

    public function sendMailReset(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|exists:users',
        ]);

        $token = Str::random(64);

        $passwordReset = Password_resets::where('email', data_get($request, 'email'))->first();
        if ($passwordReset) {
            Password_resets::where('email', data_get($request, 'email'))->limit(1)
                ->update([
                    'token' => $token,
                    'created_at' => Carbon::now()
                ]);
        } else {
            Password_resets::insert([
                'email' => data_get($request, 'email'),
                'token' => $token,
                'created_at' => Carbon::now()
            ]);
        }

        User::select('name')
            ->where('email', data_get($request, 'email'))
            ->first();

        Mail::send('email.forgetPassword', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('status', trans('passwords.sent'));
    }

    public function showResetForm($token) {
        $tokenData = password_resets::where('token', $token)
            ->first();
        $this->checkExpiredToken($tokenData);
        return view('auth.passwords.reset', ['token' => $token]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $updatePassword = password_resets::where([
                              'email' => $request->email,
                              'token' => $request->token
                            ])
                            ->first();

        if(!$updatePassword){
            return back()->withInput()->with('error', 'Invalid token!');
        }

        User::where('email', $request->email)
                    ->update(['password' => Hash::make($request->password)]);

        Password_resets::where(['email'=> $request->email])->delete();

        return redirect('/login')->with('message', 'Your password has been changed!');
    }

    private function checkExpiredToken($tokenData)
    {
        if (!$tokenData) {
            abort(404);
        }

        $token_expiry_at = Carbon::parse($tokenData->created_at)->addHour();
        if ($token_expiry_at->lessThan(Carbon::now())) {
            password_resets::where([
                'email' => $tokenData->email,
            ])->delete();
            abort(404);
        }
    }
}
