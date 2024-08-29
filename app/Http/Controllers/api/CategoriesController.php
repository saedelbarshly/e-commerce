<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(Request $request){
      $lang = $request->header('lang');
      if ($lang == '') {
        $resArr = [
          'status' => 'faild',
          'message' => trans('api.pleaseSendLangCode'),
        ];
        return response()->json($resArr);
      }
      $categories = Categories::orderBy('name_' . $lang)->get();
      $list = [];
      foreach ($categories as $category) {
        $list[] = $category->apiData($lang);
      }
      $resArr = [
        'status' => 'success',
        'data' => $list
      ];
      return response()->json($resArr);
    }
}
