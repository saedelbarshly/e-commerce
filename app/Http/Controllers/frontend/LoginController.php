<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;

class LoginController extends Controller
{
  // protected $cart;
  // public function __construct(CartRepository $cart)
  // {
  //   $this->cart = $cart;
  // }
  public function index()
  {
    $lang = app()->getLocale();
    $cartItems = getCart()['items'];
    $cartTotal = getCart()['total'];
    return view('frontend.login', [
      'title' => trans('common.login'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.login')
        ]
      ]
    ], compact('lang', 'cartItems', 'cartTotal'));
  }
}
