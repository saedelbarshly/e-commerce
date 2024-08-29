<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\WeightStoreRequest;
use App\Models\Weight;
use Illuminate\Http\Request;
use Response;

class WeightController extends Controller
{
  public function index()
  {
    $weights = Weight::orderBy('title_' . session()->get('Lang'), 'desc')->paginate(25);
    return view('AdminPanel.weight.index', [
      'active' => 'weight',
      'title' => trans('common.weight'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.weight')
        ]
      ]
    ], compact('weights'));
  }

  public function store(WeightStoreRequest $request)
  {
    $data = $request->except(['_token']);
    $weight = Weight::create($data);
    if ($request->primary) {
      $weight = Weight::where('id', '!=', $weight->id)->get();
      foreach ($weight as $old_weight) {
        $old_weight->primary = 0;
        $old_weight->save();
      }
    }
    if ($weight) {
      return redirect()->back()
        ->with('success', trans('common.successMessageText'));
    } else {
      return redirect()->back()
        ->with('faild', trans('common.faildMessageText'));
    }
  }
  public function update(WeightStoreRequest $request, $id)
  {
    $data = $request->except(['_token']);
    /*
      $id -> primary =1
      $request->primary -> 0
    */
    // $weight = Weight::whereNotIn('primary', [0])->pluck('primary', 'id')->all(); //1
    // dd($weight);

    if(!$request->primary) {
      $data['primary'] = 0;
    }else {
      $weight = Weight::where('id', '!=', $id)->get();
      foreach ($weight as $old_weight) {
        $old_weight->primary = 0;
        $old_weight->save();
      }
    }
    $update = Weight::find($id)->update($data);
    if ($update) {
      return redirect()->back()
        ->with('success', trans('common.successMessageText'));
    } else {
      return redirect()->back()
        ->with('faild', trans('common.faildMessageText'));
    }
  }
  public function delete($id)
  {
    $weight = Weight::find($id);
    if ($weight->primary == 1) {
      return Response::json("false");
    }else if($weight->primary == 0){
      $weight->delete();
      return Response::json($id);
    }else{
      return Response::json("false");
    }
  }
}
