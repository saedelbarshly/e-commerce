<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductsController extends Controller
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
      $products = Product::orderBy('ordering', 'desc')->get();
      $list = [];
      foreach ($products as $product) {
        $list[] = $product->apiData($lang);
      }
      $resArr = [
        'status' => true,
        'data' => $list
      ];
      return response()->json($resArr);
    }
    public function show(Request $request, Product $product){
      $lang = $request->header('lang');
      if ($lang == '') {
        $resArr = [
          'status' => false,
          'message' => trans('api.pleaseSendLangCode'),
        ];
        return response()->json($resArr);
      }
      $resArr = [
        'status' => true,
        'data' => $product->apiData($lang)
      ];
      return response()->json($resArr);
    }
}
