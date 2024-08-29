<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Orders;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;

class orderController extends Controller
{
    public function orderSuccess(Orders $order){
    $lang = app()->getLocale();
    // return $order->address;
    return view('frontend.order.orderSuccess', [
      'title' => trans('common.orders'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.orders')
        ]
      ]
    ], compact('lang','order'));
    }
    public function orderTracking(Orders $order){
    $lang = app()->getLocale();
    return view('frontend.order.orderTracking', [
      'title' => trans('common.orders'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.orders')
        ]
      ]
    ], compact('lang','order'));
    }
    
}
