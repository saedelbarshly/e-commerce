<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Companies;
use Illuminate\Http\Request;

class CompaniesController extends Controller
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
      $companies = Companies::orderBy('name_' . $lang)->get();
      $list = [];
      foreach ($companies as $company) {
        $list[] = $company->apiData($lang);
      }
      $resArr = [
        'status' => 'success',
        'data' => $list
      ];
      return response()->json($resArr);
    }
}
