<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cities;
use App\Models\Countries;
use App\Models\Governorates;
use App\Models\ShippingLocations;
use App\Models\ShippingLocationsItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
use Termwind\Components\Dd;

class ShippingLocationsController extends Controller
{
  public function index()
  {
    $ShippingLocations = ShippingLocations::with(['items'])->orderBy('id', 'desc')->paginate(25);
    $countries = Countries::get();
    return view('AdminPanel.ShippingLocations.index', [
      'active' => 'ShippingLocations',
      'title' => trans('common.ShippingLocations'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.ShippingLocations')
        ]
      ]
    ], compact('ShippingLocations',  'countries'));
  }

  public function store(Request $request)
  {
    // dd($request->all());
    $rules = [
      'name_ar' => 'required',
      'name_en' => 'required',
      'price' => 'required'
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)
        ->with('faild', trans('api.pleaseRecheckYourDetails'));
    }

    $data = $request->except(['_token', 'countryID', 'governorateID', 'cityID']);
    $location = ShippingLocations::create($data);
    if(isset($request->countryID)){
      $items = [];
      foreach ($request->countryID as $key => $countryID) {
        $items[] = [
          'shipping_location_id' => $location->id,
          'country_id' => $countryID,
          'governorate_id' => $request->governorateID[$key],
          'city_id' => $request->cityID[$key],
        ];
      }
      ShippingLocationsItems::insert($items);
    }
    if ($location) {
      return redirect()->back()
        ->with('success', trans('common.successMessageText'));
    } else {
      return redirect()->back()
        ->with('faild', trans('common.faildMessageText'));
    }
  }

  public function update(Request $request, ShippingLocations $location)
  {
    $rules = [
      'name_ar' => 'required',
      'name_en' => 'required',
      'price' => 'required'
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)
        ->with('faild', trans('api.pleaseRecheckYourDetails'));
    }
    $data = $request->except(['_token', 'countryID', 'governorateID', 'cityID']);
    $update = $location->update($data);
    if(isset($request->countryID)){
      $items = [];
      foreach ($request->countryID as $key => $countryID) {
        $items[] = [
          'shipping_location_id' => $location->id,
          'country_id' => $countryID,
          'governorate_id' => $request->governorateID[$key],
          'city_id' => $request->cityID[$key],
        ];
      }
      ShippingLocationsItems::where('shipping_location_id', $location->id)->delete();
      ShippingLocationsItems::insert($items);
    }
    if ($update) {
      return redirect()->back()
        ->with('success', trans('common.successMessageText'));
    } else {
      return redirect()->back()
        ->with('faild', trans('common.faildMessageText'));
    }
  }

  public function delete(ShippingLocations $location)
  {
    $id = $location->id;
    if($location->items()->count() > 0){
      foreach ($location->items as $item) {
        $item->delete();
      }
    }
    if ($location->delete()) {
      return Response::json($id);
    }
    return Response::json("false");
  }
  public function governorates(Request $request)
  {
    $data['governorates'] = Governorates::where("country_id", $request->country_id)->get(["name_ar", "id"]);
    return response()->json($data);
  }
  public function cities(Request $request)
  {
    $data['cities'] = Cities::where("governorate_id", $request->governorate_id)->get(["name_ar", "id"]);
    return response()->json($data);
  }
}
