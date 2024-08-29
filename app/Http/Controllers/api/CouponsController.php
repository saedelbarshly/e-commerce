<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Coupons;
use Illuminate\Http\Request;

class CouponsController extends Controller
{
    public function index(Request $request){
      $lang = $request->header('lang');
      if ($lang == '') {
        $resArr = [
          'status' => false,
          'message' => trans('api.pleaseSendLangCode'),
        ];
        return response()->json($resArr);
      }
      $coupons = Coupons::get();
      $couponsArr = [];
      foreach ($coupons as $coupon) {
        $couponsArr[] = $coupon->apiData($lang);
      }
      $resArr = [
        'status' => true,
        'data' => $couponsArr,
      ];
      return response()->json($resArr);
    }
}
