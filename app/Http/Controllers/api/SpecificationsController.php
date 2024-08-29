<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Specification;
use App\Models\specificationTypes;
use Illuminate\Http\Request;

class SpecificationsController extends Controller
{
    public function specificationTypes(Request $request){
      $lang = $request->header('lang');
      if ($lang == '') {
        $resArr = [
          'status' => false,
          'message' => trans('api.pleaseSendLangCode'),
        ];
        return response()->json($resArr);
      }
      $Types = specificationTypes::orderBy('ordering', 'desc')->get();
      $list = [];
      foreach ($Types as $type) {
        $list[] = $type->apiData($lang);
      }
      $resArr = [
        'status' => true,
        'data' => $list
      ];
      return response()->json($resArr);
    }
    public function specifications(Request $request){
      $lang = $request->header('lang');
      if ($lang == '') {
        $resArr = [
          'status' => false,
          'message' => trans('api.pleaseSendLangCode'),
        ];
        return response()->json($resArr);
      }
      $specifications = Specification::orderBy('ordering', 'desc')->get();
      $list = [];
      foreach ($specifications as $specification) {
        $list[] = $specification->apiData($lang);
      }
      $resArr = [
        'status' => true,
        'data' => $list
      ];
      return response()->json($resArr);
    }
}
