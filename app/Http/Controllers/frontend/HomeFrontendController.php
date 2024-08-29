<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Categories;
use App\Models\Menu;
use App\Models\Product;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;

class HomeFrontendController extends Controller
{
  public function index()
  {
    $lang = app()->getLocale();
    $cartItems = getCart()['items'];
    $cartTotal = getCart()['total'];
    $blogs = Blog::orderBy('id', 'desc')->get();
    $products = Product::with(
      ['productImages', 'categories', 'companies', 'productDiscounts', 'productSpecialOffers', 'taxType', 'length', 'specifications', 'productReviews']
    )->orderBy('id', 'desc')->take(8)->get();
    $categories = Categories::with('products')->take(3)->get();
    return view(
      'welcome',
      [
        'title' => trans('common.home'),
        'breadcrumbs' => [
          [
            'url' => '',
            'text' => trans('common.home')
          ]
        ]
      ],
      compact('blogs', 'products', 'categories', 'lang')
    );
  }
}
