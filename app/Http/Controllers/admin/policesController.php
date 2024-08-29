<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Polices;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Response;

class policesController extends Controller
{
  public function index()
  {

    $polices = Polices::orderBy('ranking', 'desc')->paginate(25);
    return view('AdminPanel.polices.index', [
      'active' => 'polices',
      'title' => trans('common.policesPrivacies'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.policesPrivacies')
        ]
      ]
    ], compact('polices'));
  }

  public function store(Request $request)
  {
    $rules = [
      'ranking' => 'required|numeric',
      'description_ar' => 'required',
      'description_en' => 'required',
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)
        ->with('faild', trans('api.pleaseRecheckYourDetails'));
    }

    $data = $request->except(['_token']);

    $Police = Polices::create($data);
    if ($Police) {
      return redirect()->back()
        ->with('success', trans('common.successMessageText'));
    } else {
      return redirect()->back()
        ->with('faild', trans('common.faildMessageText'));
    }
  }

  public function update(Request $request, Polices $police)
  {
    $rules = [
      'ranking' => 'required|numeric',
      'description_ar' => 'required',
      'description_en' => 'required',
    ];
    $validator = Validator::make($request->all(), $rules);
    $data = $request->except(['_token']);
    $police->update($data);
    if ($police) {
      return redirect()->back()
        ->with('success', trans('common.successMessageText'));
    } else {
      return redirect()->back()
        ->with('faild', trans('common.faildMessageText'));
    }
  }

  public function delete(Polices $police)
  {
    $id = $police->id;
    if ($police->delete()) {
      return Response::json($id);
    }
    return Response::json("false");
  }
}
