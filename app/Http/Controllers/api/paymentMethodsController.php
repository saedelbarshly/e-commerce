<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\UserPaymentMethods;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class paymentMethodsController extends Controller
{
  public function index(Request $request)
  {
    $lang = $request->header('lang');
    $user = auth()->user();

    if (checkUserForApi($lang, $user->id) !== true) {
      return checkUserForApi($lang, $user->id);
    }
    $list = UserPaymentMethods::where('user_id', $user->id)->orderBy('id', 'desc')->get();
    $resArr = [
      'status' => true,
      'data' => $list
    ];
    return response()->json($resArr);
  }

  public function create(Request $request){
    $lang = $request->header('lang');
    $user = auth()->user();

    if (checkUserForApi($lang, $user->id) !== true) {
      return checkUserForApi($lang, $user->id);
    }
    $rules = [
      'name' => 'required',
      'card_number' => 'required',
      'card_cvv' => 'required',
      'card_month' => 'required',
      'card_year' => 'required',
      'primary' => 'nullable'
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      foreach ((array)$validator->errors() as $error) {
        return response()->json([
          'status' => false,
          'message' => trans('api.pleaseRecheckYourDetails'),
          'data' => $error
        ]);
      }
    }

    $data = $request->except(['_token']);
    $data['user_id'] = $user->id;
    $data['card_date'] = $request->card_month . '/' . $request->card_year;
    $paymentMethod = UserPaymentMethods::create($data);
    if ($paymentMethod->update($data)) {
      $resArr = [
        'status' => true,
        'message' => trans('api.yourDataHasBeenSavedSuccessfully'),
        'data' => $paymentMethod->apiData()
      ];
    } else {
      $resArr = [
        'status' => false,
        'message' => trans('api.someThingWentWrong'),
        'data' => []
      ];
    }
    return response()->json($resArr);
  }
  public function show(Request $request, $id)
  {
    $lang = $request->header('lang');
    $user = auth()->user();

    if (checkUserForApi($lang, $user->id) !== true) {
      return checkUserForApi($lang, $user->id);
    }
    $paymentMethod = UserPaymentMethods::find($id);
    if ($paymentMethod != '') {
      $resArr = [
        'status' => true,
        'message' => trans('api.yourDataHasBeenSavedSuccessfully'),
        'data' => $paymentMethod->apiData()
      ];
    } else {
      $resArr = [
        'status' => false,
        'message' => trans('api.someThingWentWrong'),
        'data' => []
      ];
    }
    return response()->json($resArr);
  }
  public function update(Request $request, UserPaymentMethods $paymentMethod)
  {
    $lang = $request->header('lang');
    $user = auth()->user();

    if (checkUserForApi($lang, $user->id) !== true) {
      return checkUserForApi($lang, $user->id);
    }

    $rules = [
      'name' => 'required',
      'card_number' => 'required',
      'card_cvv' => 'required',
      'card_month' => 'required',
      'card_year' => 'required',
      'primary' => 'nullable'
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      foreach ((array)$validator->errors() as $error) {
        return response()->json([
          'status' => false,
          'message' => trans('api.pleaseRecheckYourDetails'),
          'data' => $error
        ]);
      }
    }

    $data = $request->except(['_token']);
    if ($paymentMethod->update($data)) {
      $resArr = [
        'status' => true,
        'message' => trans('api.yourDataHasBeenSavedSuccessfully'),
        'data' => $paymentMethod->apiData()
      ];
    } else {
      $resArr = [
        'status' => false,
        'message' => trans('api.someThingWentWrong'),
        'data' => []
      ];
    }
    return response()->json($resArr);
  }
  public function delete(Request $request, UserPaymentMethods $paymentMethod)
  {
    $lang = $request->header('lang');
    $user = auth()->user();

    if (checkUserForApi($lang, $user->id) !== true) {
      return checkUserForApi($lang, $user->id);
    }

    if ($paymentMethod->delete()) {
      $resArr = [
        'status' => true,
        'message' => trans('api.yourDataHasBeenSavedSuccessfully'),
        'data' => []
      ];
    } else {
      $resArr = [
        'status' => false,
        'message' => trans('api.someThingWentWrong'),
        'data' => []
      ];
    }
    return response()->json($resArr);
  }

}
