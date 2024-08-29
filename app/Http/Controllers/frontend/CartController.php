<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
// use App\Repositories\Cart\CartModelRepository;
// use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Termwind\Components\Dd;

class CartController extends Controller
{
  public function index()
  {
    $lang  = app()->getLocale();
    $cartItems = getCart()['items'];
    $cartItemsCount = getCart()['count_items'];
    $cartTotal = getCart()['total'];

    $item_tax = 0;
    foreach (getCart()['items'] as $key => $item) {
        $product = Product::find($item['product_id']);
        if($product != ''){
            if ($product->taxType != '') {
                if ($product->taxType->apiTaxType($lang)['taxCost'] > 0) {
                    $item_tax += $product->taxType->taxRates()->sum('price');
                }
            }
        }
    }
    $cartTotal += $item_tax;

    return view('frontend.cart.index', [
      'title' => trans('common.cart'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.cart')
        ]
      ]
    ], compact('lang', 'cartItems', 'cartTotal'));
  }
  public function store(Request $request)
  {
    $request->validate([
      'product_id' => 'required|exists:products,id',
      'quantity' => 'nullable|numeric|min:1',
      'price' => 'required|numeric|min:1',
      'option' => 'nullable',
      'optionFile' => 'nullable',
    ]);
    $imagePath = '';
    if ($request->hasFile('optionFile')) {
      $image = $request->file('optionFile');
      $name = uniqid() . \Str::random(45) . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('/uploads/cart'), $name);
      $imagePath = '/uploads/cart/' . $name;
    }
    $options = isset($request->option) ? base64_encode(serialize($request->option)) : '';
    $product = Product::findOrFail($request->product_id);
    $this->cart->add($product, $request->quantity ?? 1, $request->price, $options, $imagePath);
    return redirect()->back();
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      'product_id' => 'required|exists:products,id',
      'quantity' => 'nullable|numeric|min:1',
      'price' => 'required|numeric|min:1',
      'option' => 'nullable',
    ]);
    $product = Product::findOrFail($request->product_id);
    $options = isset($request->option) ? base64_encode(serialize($request->option)) : '';
    $this->cart->update($id, $request->quantity, $options);
  }

  public function clear()
  {
    $this->cart->clear();
    return redirect()->back();
  }

public function delete($id)
{
    if(auth()->check()) {
        if(auth()->user()->cart() != ''){
            $item = auth()->user()->cart()->items()->find($id);
            $item->options ?? $item->options()->delete();
            $item->delete();
            $sum_total = auth()->user()->cart()->items()->count() > 0 ? auth()->user()->cart()->items()->sum('total') : 0;
            auth()->user()->cart()->update(['total'=>$sum_total]);
        }
    } else {
        $last_items = [];
        if(session()->get('cartItems') != '') {
            if(is_array(session()->get('cartItems'))) {
                if(count(session()->get('cartItems')) > 0){
                    $items = session()->get('cartItems');
                    foreach($items as $item){
                        if($item['product_id'] != $id){
                            $last_items[] = $item;
                        }
                    }
                    session()->put('cartItems',$last_items);
                }
            }
        }
    }

    return [
      'status', 200,
      'message' => 'product removed successfully',
      'cartCount' => getCart()['count_items'],
      'cartTotal' => getCart()['total'] ,
    ];
}
  public function cartAjax(Request $request){
    $product = Product::findOrFail($request->product_id);
    $lang  = app()->getLocale();
    $options = [];
    // return $request->option;
    if (isset($request->option)) {
      if (is_array($request->option)) {
        foreach ($request->option as $key => $value) {
          if ($value > 0) {
            $options[$key] = $value;
          }
        }
      }
    }
    $item = [
        'product_id' => $request->product_id,
        'quantity' => 1,
        'options' => $options
    ];
    if(auth()->check()) {
        addToCart(auth()->user()->id,$item);
    } else {
        addToCart(null,$item);
    }

    $cartCount = getCart()['count_items'];
    // $cartItems = getCart()['items'];
    $cartItems = getCartItemsHtmlForAjax();
    $cartTotal = getCart()['total'];

    $cartContentList = view('frontend.layouts.topbar.cartItems',
                            compact('cartItems', 'cartCount', 'lang','cartTotal')
                            )->render();


    return [
      'message' => 'add product successfully',
      'cartContentList' => $cartItems,
      'cartCount' => $cartCount,
      'cartTotal' => $cartTotal,

    ];
  }


  public function increment(Request $request, $id)
  {
    $item = [
        'product_id' => $id,
        'quantity' => 1,
        'options' => []
    ];
    if (auth()->check()) {
      addToCart(auth()->user()->id,$item);
    } else {
      addToCart(null,$item);
    }

    return response()->json(array(
      'status' => 200,
      'message' => " incremented ",
      'itemTotal' => getCartItemTotals($id)['total']. ' ' .getDefaultCurrencySypml(),
      'cartTotal' => getCart()['total']. ' ' .getDefaultCurrencySypml(),
    ));
  }

  public function decrement(Request $request, $id)
  {
    $item = [
        'product_id' => $id,
        'quantity' => 1,
        'options' => []
    ];
    if (auth()->check()) {
      decreaseFromCart(auth()->user()->id,$item);
    } else {
      decreaseFromCart(null,$item);
    }

    return response()->json(array(
      'status' => 200,
      'message' => " incremented ",
      'itemTotal' => getCartItemTotals($id)['total']. ' ' .getDefaultCurrencySypml(),
      'cartTotal' => getCart()['total']. ' ' .getDefaultCurrencySypml(),
    ));
  }
}
