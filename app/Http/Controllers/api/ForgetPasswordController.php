<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ForgetPasswordController extends Controller
{
  public function forgetPassword(Request $request)
  {
    $checkCode = rand(100000, 999999);
    $validator = Validator::make($request->all(), [
      'email'     => 'required|email',
    ]);
    if ($validator->passes()) {
      $CheckEmail = User::where('email', $request->email)->first();
      if ($CheckEmail != '') {
        //send email
        $to      = $request->email;
        $subject = trans('api.SetANewPassword');
        $message = trans('api.YourVerificationCodeIs') . ': ' . $checkCode . '';
        $headers = array(
          "From: e-commerce",
          "Reply-To: test@e-commerce.technomasrsystems.com",
          "X-Mailer: PHP/" . PHP_VERSION
        );
        $headers = implode("\r\n", $headers);
        $mail = mail($to, $subject, $message, $headers);
        //update the mail check code
        $CheckEmail->update([
          'checkCode' => $checkCode
        ]);
        return response()->json(['status' => true, 'data' => trans('api.AnEmailHasBeenSentToYourEmailToResetYourPassword')], Response::HTTP_OK);
      } else {
        return response()->json(['status' => true, 'data' => trans('api.WeDoNotHaveAnyMembershipsWithTheEmailThatWasEntered')], Response::HTTP_NOT_FOUND);
      }
    } else {
      return response()->json(['status' => false, 'data' => $validator->errors()->first()], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
  }
  //check code
  public function checkcode(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email'     => 'required|email',
      'checkCode'     => 'required',
    ]);
    if ($validator->passes()) {
      $CheckEmail = User::where('email', $request->email)->first();
      if ($CheckEmail != '') {
        if ($CheckEmail->checkCode == $request->checkCode) {
          return response()->json(['status' => true, 'data' => trans('api.TheCodeHasBeenConfirmedSuccessfully')], Response::HTTP_OK);
        } else {
          return response()->json(['status' => false, 'data' => trans('api.TheCodeIsWrong')], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
      } else {
        return response()->json(['status' => true, 'data' => trans('api.WeDoNotHaveAnyMembershipsWithTheEmailThatWasEntered')], Response::HTTP_NOT_FOUND);
      }
    } else {
      return response()->json(['status' => false, 'data' => $validator->errors()->first()], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
  }
  public function ResetPassword(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'email'     => 'required|email',
      'password'     => 'required',
      'password_confirmation'     => 'required|same:password',
    ]);
    if ($validator->passes()) {
      $CheckEmail = User::where('email', $request->email)->first();
      if ($CheckEmail != '') {
        $CheckEmail->update([
          'password' => Hash::make($request->password)
        ]);
        return response()->json(['status' => true, 'data' => trans('api.PasswordChangedSuccessfully')], Response::HTTP_OK);
      } else {
        return response()->json(['status' => true, 'data' => trans('api.WeDoNotHaveAnyMembershipsWithTheEmailThatWasEntered')], Response::HTTP_NOT_FOUND);
      }
    } else {
      return response()->json(['status' => false, 'data' => $validator->errors()->first()], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
  }
}
