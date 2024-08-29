<?php

namespace App\Repositories\Cart;
use App\Models\Cart;
use App\Models\Coupons;
//use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

 class CartModelRepository implements CartRepository{
    protected $items ;
    public function __construct(){
      $this->items = collect([]);
    }
    public function get() : Collection{
      if(!$this->items->count()){
        $this->items = Cart::with('product')->get();
      }
      return $this->items;
      // return auth()->check() ? auth()->user()->carts : session()->get('cart');
    }
    public function add(Product $product, $quantity = 1, $price, $options = [], $imagePath = ''){
      $item = Cart::where('product_id', $product->id)->first();
      if(!$item){
        $cart = Cart::create([
          'user_id' => auth()->id(),
          'product_id' => $product->id,
          'quantity' => $quantity,
          'price' => $product->price,
          'options' => $options,
          'image' => $imagePath,
          'total' => $price * $quantity
        ]);
        $this->get()->push($cart);
        return $cart;
      }
      $item_tax = 0;
      if ($item->product != '') {
        if ($item->product->taxType != '') {
          if ($item->product->taxType->apiTaxType($lang)['taxCost'] > 0) {
            $item_tax = $item->product->taxType->taxRates()->sum('price');
          }
        }
      }

      return $item->increment('quantity', $quantity, [
        'total' => $item->total + ($price * $quantity) + $item_tax
      ]);
    }
    public function update($id, $quantity, $options = []){
      Cart::where('id', $id)->update([
        'quantity' => $quantity,
        'options' => $options,
        'total' => $quantity * $this->get()->find($id)->price
      ]);
    }
    public function delete($id){
      Cart::where('id', $id)->delete();
    }
    public function clear(){
      Cart::query()->delete();
    }
    public function total(): float
    {
       return (float)Cart::where('cookie_id', $this->getCookieId())->join('products' , 'products.id', '=', 'carts.product_id')->selectRaw('SUM(products.price * carts.quantity) as total')->value('total');
     // return $this->get()->sum('total');
    }

    protected function getCookieId(){
      $cookie_id = Cookie::get('cookie_id');
      if(!$cookie_id){
        $cookie_id = Str::uuid();
        Cookie::queue('cookie_id', $cookie_id,now()->addDays(30));
      }
      return $cookie_id;
    }
    public function applyCoupon($coupon)
    {
      $coupon = Coupons::where('coupon', $coupon)->first();
      if($coupon != ''){
        if($coupon->arabicStatus()['status'] == 1){
          $total = $this->total();
          $percentage = $coupon->percentage;
          $discount = $total * ($percentage / 100);
          $discounted = $total - $discount;
          $resArr = [
            'status' => 1,
            'discount' => $discount,
            'discounted' => $discounted
          ];
        }else{
          $resArr = [
            'status' => 0,
            'message' => $coupon->arabicStatus()['message']
          ];
        }
      }else {
        $resArr =  [
        'status' => 0,
        'message' => trans('common.InvalidCoupon')
      ];
    }
      return $resArr;
    }

}
