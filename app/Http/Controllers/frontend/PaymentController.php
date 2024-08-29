<?php

namespace App\Http\Controllers\frontend;

use Exception;
use App\Models\Orders;
use App\Models\Product;
use App\Models\OrderItems;
use Termwind\Components\Dd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\orderAddress;
use App\Repositories\Cart\CartRepository;
use Egulias\EmailValidator\Result\Reason\UnclosedQuotedString;
use MyFatoorah\Library\PaymentMyfatoorahApiV2;

class PaymentController extends Controller
{
  protected $cart;
  public $mfObj;
  public function __construct(CartRepository $cart)
  {
    $this->cart = $cart;
    $this->mfObj = new PaymentMyfatoorahApiV2(config('myfatoorah.api_key'), config('myfatoorah.country_iso'), config('myfatoorah.test_mode'));
  }


  // public function index(Orders $order)
  public function index($id)
  {
    $lang = app()->getLocale();
    $cartItems = getCart()['items'];
    $cartTotal = getCart()['total'];
    $order = auth()->user()->cart();
    return view('frontend.payment.index', [
      'title' => trans('common.payment'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.payment')
        ]
      ]
    ], compact('cartItems', 'cartTotal', 'lang', 'id', 'order'));
  }
  //   public function getCheckOutId(Orders $order)
  //   {
  //     $url = "https://test.oppwa.com/v1/checkouts";
  //     $data = "entityId=8ac7a4c985a05c5c0185a0eb19290129" .
  //       "&amount=92.00" .
  //       "&currency=SAR" .
  //       "&paymentType=DB";

  //     $ch = curl_init();
  //     curl_setopt($ch, CURLOPT_URL, $url);
  //     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  //       'Authorization:Bearer OGFjN2E0Yzk4NWEwNWM1YzAxODVhMGVhMTZhYzAxMjV8NmF0d3dFc2RzNw=='
  //     ));
  //     curl_setopt($ch, CURLOPT_POST, 1);
  //     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
  //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  //     $responseData = curl_exec($ch);
  //     if (curl_errno($ch)) {
  //       return curl_error($ch);
  //     }
  //     curl_close($ch);
  //     $responseData = json_decode($responseData, true);
  //     // $checkoutId  = substr($responseData['id'], 0, strpos($responseData['id'], '.'));
  //     $order->update([
  //       'checkout_id' => $responseData['id']
  //     ]);
  //     $view = view('frontend.payment.ajaxMain', compact('responseData', 'order'))->renderSections();
  //     return response()->json([
  //       'status' => true,
  //       'content' => $view['main']
  //     ]);
  //   }

  //   public function payment(Request $request)
  //   {
  //     $url = "https://test.oppwa.com/v1/payments";
  //     $data = "entityId=8ac7a4c985a05c5c0185a0eb19290129" .
  //       "&amount=" . $this->cart->total() .
  //       "&currency=SAR" .
  //       "&paymentBrand=VISA" .
  //       "&paymentType=DB" .
  //       "&card.number=$request->card_number" .
  //       "&card.holder=Jane Jones" .
  //       "&card.expiryMonth=05" .
  //       "&card.expiryYear=2034" .
  //       "&card.cvv=123";

  //     $ch = curl_init();
  //     curl_setopt($ch, CURLOPT_URL, $url);
  //     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  //       'Authorization:Bearer OGFjN2E0Yzk4NWEwNWM1YzAxODVhMGVhMTZhYzAxMjV8NmF0d3dFc2RzNw=='
  //     ));
  //     curl_setopt($ch, CURLOPT_POST, 1);
  //     curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  //     curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
  //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  //     $responseData = curl_exec($ch);
  //     if (curl_errno($ch)) {
  //       return curl_error($ch);
  //     }
  //     curl_close($ch);
  //     return $responseData;
  //   }



  
  public function callback(Request $request)
  {
    // return $this->paymentStatus(request('id'), request('resourcePath'),auth()->user()->cart()->payment_method);
    if (request('id') && request('resourcePath')) {
      $checkStatus = $this->paymentStatus(request('id'), request('resourcePath'), auth()->user()->cart()->payment_method);
      $pattern = "/^(000.000.|000.100.1|000.[36]|000.400.[1][12]0)/";
      if (preg_match($pattern, $checkStatus['result']['code'])) {
        $order = auth()->user()->cart();
        auth()->user()->cart()->update([
          'payment_status' => 'paid',
          'status' => 'new'
        ]);
        return redirect()->route('orders.success', ['order' => $order->id]);
      } else {
        return redirect()->back()->with('error', $checkStatus['result']['description']);
      }
    }
    return redirect()->route('e-commerce.checkout');
  }


  // public function paymentStatus($id, $resourcePath, $payment_method)
  // {
  //   //   return 'gg';
  //   $url = "https://test.oppwa.com/v1/checkouts/";
  //   $url .= $id;
  //   if ($payment_method == 'mada') {
  //     $url .= "/payment?entityId=8ac7a4c985a05c5c0185a0ec1031012d";
  //   } else {
  //     $url .= "/payment?entityId=8ac7a4c985a05c5c0185a0eb19290129";
  //   }
  //   $ch = curl_init();
  //   curl_setopt($ch, CURLOPT_URL, $url);
  //   curl_setopt($ch, CURLOPT_HTTPHEADER, array(
  //     'Authorization:Bearer OGFjN2E0Yzk4NWEwNWM1YzAxODVhMGVhMTZhYzAxMjV8NmF0d3dFc2RzNw=='
  //   ));
  //   curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
  //   curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // this should be set to true in production
  //   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  //   $responseData = curl_exec($ch);
  //   if (curl_errno($ch)) {
  //     return curl_error($ch);
  //   }
  //   curl_close($ch);
  //   return json_decode($responseData, true);
  // }


}
