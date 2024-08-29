<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Countries;
use App\Models\Governorates;
use Illuminate\Http\Request;
use Response;
class GovernoratesController extends Controller
{
  public function index($countryId)
  {
    $country = Countries::find($countryId);
    $governorates = Governorates::with(['cities', 'users', 'country'])->where('country_id', $countryId)->orderBy('name_' . session()->get('Lang'), 'desc')->paginate(25);
    return view('AdminPanel.governorates.index', [
      'active' => 'countries',
      'title' => trans('common.governorates'),
      'breadcrumbs' => [
        [
          'url' => route('admin.countries'),
          'text' => trans('common.Countries')
        ],
        [
          'url' => '',
          'text' => $country['name_' . session()->get('Lang')] != '' ? $country['name_' . session()->get('Lang')] : $country['name_en']
        ],
        [
          'url' => '',
          'text' => trans('common.governorates')
        ]
      ]
    ], compact('governorates', 'country'));
  }
  public function store(Request $request, $countryId)
  {
    $data = $request->except(['_token']);
    $governorate = Governorates::create($data);
    if ($governorate) {
      return redirect()->route('admin.governorates', ['countryId' => $countryId])
        ->with('success', trans('common.successMessageText'));
    } else {
      return redirect()->back()
        ->with('faild', trans('common.faildMessageText'));
    }
  }

  public function update(Request $request, $countryId ,$governorateId)
  {
    $data = $request->except(['_token']);
    $governorate = Governorates::findOrfail($governorateId);
    $update = $governorate->update($data);
    if ($update) {
      return redirect()->back()
        ->with('success', trans('common.successMessageText'));
    } else {
      return redirect()->back()
        ->with('faild', trans('common.faildMessageText'));
    }
  }

  public function delete($countryId, $governorateId)
  {
    $governorate = Governorates::findOrfail($governorateId);
    if ($governorate->delete()) {
      return Response::json($governorateId);
    }
    return Response::json("false");
  }

}
