<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class SocialLoginController extends Controller
{
  public function socialLogin(Request $request)
  {
    $lang = $request->header('lang');
    if ($lang == '') {
      $resArr = [
        'status' => false,
        'message' => trans('api.pleaseSendLangCode'),
        'data' => []
      ];
      return response()->json($resArr);
    }
    $provider = $request->header('provider');
    try {
      $user = User::where('email', $request->email)->first();
      if (!$user) {
        $user = User::create([
          'name' => $request->name,
          'email' => $request->email,
          'password' => Hash::make($request->provider_id),
          'provider' => $provider,
          'provider_id' => $request->provider_id,
          'language' => in_array($lang, ['ar', 'en']) ? $lang : 'ar',
        ]);
      }
      return response()->json([
        "status" => true,
        'token' => $user->createToken("API TOKEN")->plainTextToken,
        'data' => $user->apiData($lang),

      ], Response::HTTP_OK);
    } catch (\Exception $e) {
      return response()->json($e->getMessage());
    }
  }
}
