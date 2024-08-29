<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\taxRate;
use App\Models\taxType;
use Illuminate\Http\Request;
use Response;

class taxTypesController extends Controller
{
  public function index()
  {
    $taxTypes = taxType::with(['taxRates', 'taxCosts'])->paginate(10);
    $taxRates = taxRate::with('taxTypes')->get();
    // dd($taxTypes);
    return view('AdminPanel.taxType.index', [
      'active' => 'taxTypes',
      'title' => trans('common.taxRate'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.taxRate')
        ]
      ]
    ], compact('taxTypes', 'taxRates'));
  }
  public function store(Request $request)
  {
    //  dd($request->all());
    $role = [
      'name_ar' => 'required|string',
      'name_en' => 'required|string',
      'description_ar' => 'required|string',
      'description_en' => 'required|string',
    ];
    $data = $this->validate($request, $role);
    // dd($data, $request->all());
    $taxType = taxType::create($data);
    if(isset($_POST['option_taxRateID'])){
      for ($i=0; $i < count($request->option_taxRateID); $i++) {
        $taxCost = $taxType->taxRates()->attach($request->option_taxRateID[$i]);
        $taxCost = $taxType->taxRates()->updateExistingPivot($request->option_taxRateID[$i], ['basedOn' => $request->option_baseOn[$i]]);
        $taxCost = $taxType->taxRates()->updateExistingPivot($request->option_taxRateID[$i], ['priority' => $request->option_priority[$i]]);
      }
    }
    if ($taxType) {
      return redirect()->back()
        ->with('success', trans('common.successMessageText'));
    } else {
      return redirect()->back()
        ->with('faild', trans('common.faildMessageText'));
    }
  }
  public function update(Request $request, taxType $taxType)
  {
    $role = [
      'name_ar' => 'required|string',
      'name_en' => 'required|string',
      'description_ar' => 'required|string',
      'description_en' => 'required|string',
    ];
    $data = $this->validate($request, $role);
    $update = $taxType->update($data);
    if(isset($_POST['option_taxRateID'])){
      $taxCost = $taxType->taxRates()->sync($request->option_taxRateID);
      foreach($_POST['option_baseOn'] as $key => $value){
        $taxCost = $taxType->taxRates()->updateExistingPivot($request->option_taxRateID, ['basedOn' => $value]);
      }
      foreach($_POST['option_priority'] as $key => $value){
        $taxCost = $taxType->taxRates()->updateExistingPivot($request->option_taxRateID, ['priority' => $value]);
      }
    }
    if ($update) {
      return redirect()->back()
        ->with('success', trans('common.successMessageText'));
    } else {
      return redirect()->back()
        ->with('faild', trans('common.faildMessageText'));
    }
  }

  public function delete(taxType $taxType)
  {
    if ($taxType->delete()) {
      return Response::json($taxType->id);
    } else {
      return Response::json("false");
    }
  }
}
