<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Countries;
use App\Models\Governorates;
use App\Models\Cities;
use Response;

class CitiesController extends Controller
{
    public function index($countryId, $governorateId)
    {
        $country = Countries::find($countryId);
        $governorate = Governorates::find($governorateId);
        $cities = Cities::where('country_id',$countryId)->orderBy('name_'.session()->get('Lang'),'desc')->paginate(25);
        return view('AdminPanel.cities.index',[
            'active' => 'countries',
            'title' => trans('common.cities'),
            'cities' => $cities,
            'governorate' => $governorate,
            'country' => $country,
            'breadcrumbs' => [
                [
                    'url' => route('admin.countries'),
                    'text' => trans('common.Countries')
                ],
                [
                    'url' => route('admin.governorates',['countryId'=>$countryId]),
                    'text' => $country['name_'.session()->get('Lang')] != '' ? $country['name_'.session()->get('Lang')] : $country['name_en']
                ],
                [
                    'url' => route('admin.cities',['countryId'=>$countryId,'governorateId'=>$governorateId]),
                    'text' => $governorate['name_'.session()->get('Lang')] != '' ? $governorate['name_'.session()->get('Lang')] : $governorate['name_ar']
                ],
                [
                    'url' => '',
                    'text' => trans('common.cities')
                ]
            ]
        ]);
    }

    public function store(Request $request,$countryId, $governorateId)
    {
        $data = $request->except(['_token']);
        $data['country_id'] = $countryId;
        $data['governorate_id'] = $governorateId;
        $city = Cities::create($data);
        if ($city) {
            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }

    public function update(Request $request, $countryId, $governorateId, $cityId)
    {
        $data = $request->except(['_token']);

        $update = Cities::find($cityId)->update($data);
        if ($update) {
            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }

    public function delete($countryId, $governorateId, $cityId)
    {
        $city = Cities::find($cityId);
        if ($city->delete()) {
            return Response::json($cityId);
        }
        return Response::json("false");
    }
}
