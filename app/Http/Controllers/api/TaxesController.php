<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\taxCost;
use App\Models\taxRate;
use App\Models\taxType;
use Illuminate\Http\Request;

class TaxesController extends Controller
{
  public function taxType(Request $request)
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
    $taxTypes = taxType::orderBy('name_' . $lang)->get();
    $list = [];
    foreach ($taxTypes as $taxType) {
      $list[] = $taxType->apiTaxType($lang);
    }
    $resArr = [
      'status' => 'success',
      'data' => $list
    ];
    return response()->json($resArr);
   }

   public function taxRate(Request $request){
    $lang = $request->header('lang');
    if ($lang == '') {
      $resArr = [
        'status' => 'faild',
        'message' => trans('api.pleaseSendLangCode'),
        'data' => []
      ];
      return response()->json($resArr);
    }
    $taxRates = taxRate::orderBy('name_' . $lang)->get();
    $list = [];
    foreach ($taxRates as $taxRate) {
      $list[] = $taxRate->apiTaxRate($lang);
    }
    $resArr = [
      'status' => 'success',
      'data' => $list
    ];
    return response()->json($resArr);
   }

   public function taxCost(Request $request){
    $lang = $request->header('lang');
    if ($lang == '') {
      $resArr = [
        'status' => 'faild',
        'message' => trans('api.pleaseSendLangCode'),
        'data' => []
      ];
      return response()->json($resArr);
    }
    $taxCosts = taxCost::get();
    $list = [];
    foreach ($taxCosts as $taxCost) {
      $list[] = $taxCost->apiTaxCost($lang);
    }
    $resArr = [
      'status' => 'success',
      'data' => $list
    ];
    return response()->json($resArr);
   }
}
