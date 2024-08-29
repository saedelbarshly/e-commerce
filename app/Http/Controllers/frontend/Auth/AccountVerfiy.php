<?php

namespace App\Http\Controllers\frontend\Auth;


use App\http\Controllers\Controller;
use App\Http\Controllers\Utils\MoraSmsProvider;
use App\Models\User;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountVerfiy extends Controller
{
  public function showVerfiyForm()
  {

    $user = User::orderBy('id', 'desc')->latest()->first();

    return view("frontend.auth.index",[
      'title' => trans("common.VERFIYACCOUNT"),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans("common.VERFIYACCOUNT"),
        ]
      ]
    ], compact('user'));
  }

  public function verfiy(Request $request)
  {
    $user = User::where("id", $request->id)->first();
    $this->validate($request, ['otp' => 'required|digits:6']);

    if ($user->otp == $request->otp) {
      $user->update([
        'block' => 0,
        'active' => 1,
        'verifyCode' => 1,
      ]);

      return redirect()->route("user.login")->with("success", trans("common.successfullyVerfiy"));
    }

    return back()->with("error", trans("common.otp_not_valid"));
  }

  public function resentCode(Request $request)
  {

    $otp = otp_genrator();

    if ($user = User::where("id", $request->id)->first()) {
      $user->update(['otp' => $otp]);

      MoraSmsProvider::sendSms($user['phone'], trans('common.otp_code_sms' . $user['otp']));

      return redirect()->back()->with("success", trans("common.resentverfiy"));
    }

    return back()->with("error", trans("common.otp_not_valid"));
  }
}
