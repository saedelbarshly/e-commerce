<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AramexAPIController extends Controller
{

    public function getCountryCities($country_code)
    {
        return getCountryCitiesFromAramex($country_code);
        $lang = $request->header('lang');
        $user_id = $request->header('user');
        
        if (checkUserForApi($lang, $user_id) !== true) {
            return checkUserForApi($lang, $user_id);
        }
        $shipping_id = $request['shipping_id'];
        $publisher_Country_Code = $request['publisher_Country_Code'];
        $publisher_City = $request['publisher_City'];
        $currency = $request['currency'];

        $shipping_id = $request['shipping_id'];
        $shippingData = UserAddress::find($shipping_id);
        $resArr = [
            'status' => 'success',
            'message' => '',
            'data' => shippingCalculator($publisher_Country_Code, $publisher_City, 'eg', 'dakahlia', $currency)
        ];
        return response()->json($resArr);

    }
    public function getAramexCountryCities()
    {
        $country = $_GET['country'];
        $cities = aramexCities($country);
        $list = [];
        foreach ($cities as $key => $value) {
            $list[] = [
                'id' => $value,
                'name' => $value
            ];
        }
        return $list;
    }
}
