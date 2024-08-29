<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Repositories\Cart\CartRepository;

use App\Models\User;
use Mail;
use Hash;
use Illuminate\Support\Str;

class ForgotPasswordController extends Controller
{
  public function showForgetPasswordForm()
  {
    $lang = app()->getLocale();
    return view('frontend.forgetPassword.forgetPassword',[
      'title' => trans('common.forgetPassword'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.forgetPassword')
        ]
      ]
    ], compact('lang'));
  }

  public function submitForgetPasswordForm(Request $request)
  {
    $request->validate([
      'email' => 'required|email|exists:users',
    ]);

    $token = Str::random(64);

    DB::table('password_resets')->insert([
      'email' => $request->email,
      'token' => $token,
      'created_at' =>now()
    ]);

    Mail::send('frontend.forgetPassword.forgetPasswordEmail', ['token' => $token], function ($message) use ($request) {
      $message->to($request->email);
      $message->subject('Reset Password');
    });

    return back()->with('message', 'We have e-mailed your password reset link!');
  }

  public function showResetPasswordForm($token)
  {
    $lang = app()->getLocale();
    return view('frontend.forgetPassword.forgetPasswordLink',
      compact('lang', 'token'));
  }


  public function submitResetPasswordForm(Request $request)
  {
    $request->validate([
      'email' => 'required|email|exists:users',
      'password' => 'required|string|min:6|confirmed',
      'password_confirmation' => 'required'
    ]);
    $updatePassword = DB::table('password_resets')
    ->where([
      'email' => $request->email,
      'token' => $request->token
    ])
      ->first();
    if (!$updatePassword) {
      return back()->withInput()->with('error', 'Invalid token!');
    }
    $user = User::where('email', $request->email)
      ->update(['password' => Hash::make($request->password)]);
    DB::table('password_resets')->where(['email' => $request->email])->delete();
    return redirect('/')->with('message', 'Your password has been changed!');
  }
}
