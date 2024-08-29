<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Currencies;
use Illuminate\Http\Request;

class CurrenciesController extends Controller
{
     public function index(Request $request){
        $lang = $request->header('lang');
        if ($lang == '') {
          $resArr = [
            'status' => 'faild',
            'message' => trans('api.pleaseSendLangCode'),
            'data' => []
          ];
          return response()->json($resArr);
        }
        $currencies = Currencies::orderBy('name_'.$lang)->get();
        $list = [];
        foreach ($currencies as $currency) {
          $list[] = $currency->apiData($lang);
        }
        $resArr = [
          'status' => 'success',
          'message' => '',
          'data' => $list
        ];
        return response()->json($resArr);
     }
}
