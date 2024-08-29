<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Product;
use App\Models\Wishlist;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;

class wishlistController extends Controller
{
  public function index()
  {
    $lang = app()->getLocale();
    $wishlists = Wishlist::with('product')->where('user_id', auth()->user()->id)->get();
    return view('frontend.wishlist.index', [
      'title' => trans('common.wishlist'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.wishlist')
        ]
      ]
    ], compact('lang', 'wishlists'));
  }
  public function addItem(Request $request)
  {
    $user = auth()->user();
    $product_id = Product::find($request->product_id);
    $wishlistItem = $user->wishlist()->where('product_id', $product_id)->first();
    if ($wishlistItem == '') {
      $item = Wishlist::create([
        'product_id' => $request->product_id,
        'user_id' => $user->id
      ]);
    }
     return response()->json(array(
       'status' => 200,
       'message' => "added successfully ",
    ));
  }

  // public function addItem(Request $request)
  // {
  //    $user = auth()->user();
  //    $request->validate([
  //      'product_id' => 'required|exists:products,id',
  //   ]);
  //   $product_id = Product::findOrFail($request->product_id);
  //   $wishlistItem = $user->wishlist()->where('product_id', $product_id)->first();

  //   if (!$wishlistItem) {
  //      $item = Wishlist::create([
  //      'product_id' => $product_id,
  //        'user_id' => $user->id
  //     ]);
  //    }
  //   //dd($product_id);
  //   return response()->json(array(
  //     'status' => 200,
  //     'message' => "added successfully ",
  //   ));
  // }


  public function delete(Wishlist $wishlist)
  {
    $wishlist->delete();
    return redirect()->back();
  }
}
