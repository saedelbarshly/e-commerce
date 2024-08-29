<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\taxRate;
use Illuminate\Http\Request;
use Response;

class taxRatesController extends Controller
{
  public function index()
  {
    $taxRates = taxRate::paginate(20);
    return view('AdminPanel.taxRate.index', [
      'active' => 'taxRates',
      'title' => trans('common.taxRate'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.taxRate')
        ]
      ]
    ], compact('taxRates'));
  }

  public function store(Request $request)
  {
    $role = [
      'name_ar' => 'required',
      'name_en' => 'required',
      'price' => 'required',
      'type' => 'required',
      'geographicalArea' => 'required',
    ];
    $data = $this->validate($request, $role);
    $taxRate = taxRate::create($data);
    if ($taxRate) {
      return redirect()->back()
        ->with('success', trans('common.successMessageText'));
    } else {
      return redirect()->back()
        ->with('faild', trans('common.faildMessageText'));
    }
  }
  public function update(Request $request, taxRate $taxRate)
  {
    $role = [
      'name_ar' => 'required',
      'name_en' => 'required',
      'price' => 'required',
      'type' => 'required',
      'geographicalArea' => 'required',
    ];
    $data = $this->validate($request, $role);
    $update = $taxRate->update($data);
    if ($update) {
      return redirect()->back()
        ->with('success', trans('common.successMessageText'));
    } else {
      return redirect()->back()
        ->with('faild', trans('common.faildMessageText'));
    }
  }

  public function delete(taxRate $taxRate)
  {
    if($taxRate->delete()){
      return Response::json($taxRate->id);
    }else{
        return Response::json("false");
      }
    }
}
