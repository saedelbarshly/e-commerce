<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\orderAddress;
use App\Models\OrderItems;
use App\Models\Orders;
use App\Models\Product;
use App\Models\ShippingLocations;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Countries;

class checkoutController extends Controller
{
  public function index()
  {
    $lang = app()->getLocale();
    $countries = Countries::orderBy('id','asc')->pluck('name_'.$lang,'iso')->all();
    $cartItems = getCart()['items'];
    $cartTotal = getCart()['total'];
    $ShippingLocations = ShippingLocations::with('items')->get();
    $order = auth()->user()->cart();
    return view('frontend.checkout.index', [
      'title' => trans('common.checkOut'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.checkOut')
        ]
      ]
    ], compact('lang', 'countries', 'cartItems', 'cartTotal', 'ShippingLocations','order'));
  }

  public function store(Request $request)
  {
    $rules = [
      'first_name' => 'required',
      'last_name' => 'required',
      'email' => 'required|email',
      'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
      'city' => 'required',
      'country' => 'required',
      'address' => 'required',
      'postalCode' => 'required',
    ];
    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
      return redirect()->back()->withErrors($validator)->withInput();
    }
    $order = auth()->user()->cart();
    if (auth()->user()->cart()->address != '') {
      $userAddress = auth()->user()->cart()->address()->update([
        'user_id' => auth()->id(),
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'phone' => $request->phone,
        'city' => $request->city,
        'country' => $request->country,
        'address' => $request->address,
        'postalCode' => $request->postalCode,
        'type' => 'shipping'
      ]);
    } else {
      $userAddress = orderAddress::create([
        'user_id' => auth()->id(),
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => $request->email,
        'phone' => $request->phone,
        'city' => $request->city,
        'country' => $request->country,
        'address' => $request->address,
        'postalCode' => $request->postalCode,
        'type' => 'shipping'
      ]);
      auth()->user()->cart()->update([
        'shipping_address_id' =>$userAddress->id
      ]);
    }
    auth()->user()->cart()->update([
      'payment_status' => 'paid',
      'status' => 'new'
    ]);
    //return redirect()->route('orders.success', ['order' => $order->id]);
     return redirect()->route('myfatoorah');

    // if (!$userAddress) {
    //   return redirect()->back();
    // }
    /*auth()->user()->cart()->update([
      'chooseDeliveryMethod' => $request->chooseDeliveryMethod,
      'payment_method' => $request->payment_method
    ]);

    $url = "https://test.oppwa.com/v1/checkouts";
    $data = "currency=SAR";
    if ($request->payment_method == 'mada') {
      $data .= "&entityId=8ac7a4c985a05c5c0185a0ec1031012d";
    } else {
      $data .= "&entityId=8ac7a4c985a05c5c0185a0eb19290129";
    }

    $data .= "&amount="  .getCart()['total'].
    "&paymentType=DB".
    "&merchantTransactionId=".strtotime(date('Y-m-d H:i:s')).
    "&customer.email=".$request->email.
    "&customer.mobile=".$request->phone.
    "&billing.street1=".$request->address.
    "&billing.city=".$request->city.
    "&billing.state=".$request->city.
    "&billing.country=".$request->country.
    "&billing.postcode=".$request->postalCode.
    "&customer.givenName=".$request->first_name.
    "&customer.surname=".$request->last_name;

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Authorization:Bearer OGFjN2E0Yzk4NWEwNWM1YzAxODVhMGVhMTZhYzAxMjV8NmF0d3dFc2RzNw=='
    ));
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $responseData = curl_exec($ch);
    if (curl_errno($ch)) {
      return curl_error($ch);
    }
    curl_close($ch);
    $data = json_decode($responseData, true);
    return redirect()->route('checkout.success', ['id' => $data['id']])->with('success', trans('common.checkOutSuccess'));
    return redirect()->route('e-commerce.index');
    */
  }

  public function applyCoupon(Request $request)
  {
    // $request->validate([
    //   'coupon' => 'required|exists:coupons,coupon'
    // ]);
    $result = $this->cart->applyCoupon($request->coupon);
    if ($result['status'] == 1) {
      return response()->json([
        'status' => 1,
        'total' => round($result['discounted'], 2),
        'message' => trans('common.ValidCoupon'),
      ]);
    }
    return response()->json([
      'status' => 0,
      'total' => $this->cart->total(),
      'message' => trans('common.InvalidCoupon')
    ]);
  }
}
