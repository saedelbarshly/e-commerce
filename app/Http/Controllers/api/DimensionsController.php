<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Length;
use App\Models\Weight;
use Illuminate\Http\Request;

class DimensionsController extends Controller
{
    public function length(Request $request)
    {
      $lang = $request->header('lang');
      if ($lang == '') {
        $resArr = [
          'status' => 'faild',
          'message' => trans('api.pleaseSendLangCode'),
          'data' => []
        ];
        return response()->json($resArr);
      }
      $lengths = Length::orderBy('title_' . $lang)->get();
      $list = [];
      foreach ($lengths as $length) {
        $list[] = $length->apiData($lang);
      }
      $resArr = [
        'status' => 'success',
        'data' => $list
      ];
      return response()->json($resArr);
    }
    public function width(Request $request)
    {
      $lang = $request->header('lang');
      if ($lang == '') {
        $resArr = [
          'status' => 'faild',
          'message' => trans('api.pleaseSendLangCode'),
          'data' => []
        ];
        return response()->json($resArr);
      }
      $weights = Weight::orderBy('title_' . $lang)->get();
      $list = [];
      foreach ($weights as $weight) {
        $list[] = $weight->apiData($lang);
      }
      $resArr = [
        'status' => 'success',
        'data' => $list
      ];
      return response()->json($resArr);
    }
}
