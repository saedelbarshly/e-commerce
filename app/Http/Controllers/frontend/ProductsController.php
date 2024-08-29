<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Companies;
use App\Models\Menu;
use App\Models\Product;
use App\Models\ProductOptionItems;
use App\Models\productReview;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Response;

class ProductsController extends Controller
{
  protected $cart;
  public function __construct(CartRepository $cart)
  {
    $this->cart = $cart;
  }
  public function gifts()
  {
    $lang = app()->getLocale();
    $companies = Companies::pluck('name_' . $lang, 'id');
    $categories = Categories::pluck('name_' . $lang, 'id');
    $newProducts = Product::where('gift','yes')->with(
      ['productImages', 'categories', 'companies', 'productDiscounts', 'productSpecialOffers', 'taxType', 'length', 'specifications']
    )->orderBy('id', 'desc')->take(9)->get();
    $products = Product::where('gift','yes')->with('categories')->orderBy('id', 'asc');
    if (isset($_GET['category_id'])) {
      $products = $products->whereIn('category_id', $_GET['category_id']);
    }
    if (isset($_GET['company_id'])) {
      $products = $products->whereIn('company_id', $_GET['company_id']);
    }
    $products = $products->paginate(12);
    return view('frontend.products.index', [
      'title' => trans('common.products'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.products')
        ]
      ]
    ], compact('products', 'lang', 'companies', 'categories', 'newProducts'));
  }
  public function index()
  {
    $lang = app()->getLocale();
    $companies = Companies::pluck('name_' . $lang, 'id');
    $categories = Categories::pluck('name_' . $lang, 'id');
    $newProducts = Product::with(
      ['productImages', 'categories', 'companies', 'productDiscounts', 'productSpecialOffers', 'taxType', 'length', 'specifications']
    )->orderBy('id', 'desc')->take(9)->get();
    $products = Product::with('categories')->orderBy('id', 'asc');
    if (isset($_GET['category_id'])) {
      $products = $products->whereIn('category_id', $_GET['category_id']);
    }
    if (isset($_GET['company_id'])) {
      $products = $products->whereIn('company_id', $_GET['company_id']);
    }
    if (isset($_GET['name'])) {
      $products = $products->where('name_ar','LIKE', '%'.$_GET['name'].'%')->orWhere('name_en','LIKE', '%'.$_GET['name'].'%');
    }
    $products = $products->paginate(12);
    return view('frontend.products.index', [
      'title' => trans('common.products'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.products')
        ]
      ]
    ], compact('products', 'lang', 'companies', 'categories', 'newProducts'));
  }
  public function show(Product $product)
  {
    // return getCart();
    $lang = app()->getLocale();
    $product->load([
      'productImages', 'categories', 'companies', 'productDiscounts', 'productSpecialOffers', 'taxType', 'length', 'specifications', 'options'
    ]);
    $newProducts = Product::with(
      ['productImages', 'categories', 'companies', 'productDiscounts', 'productSpecialOffers', 'taxType', 'length', 'specifications']
    )->orderBy('id', 'desc')->take(9)->get();
    $relatedProducts = Product::with(
      ['productImages', 'categories', 'companies', 'productDiscounts', 'productSpecialOffers', 'taxType', 'length', 'specifications']
    )->where('id', '!=', $product->id)->where('category_id', $product->category_id)->take(6)->get();

    return view('frontend.products.show', [
      'title' => $product->name,
      'breadcrumbs' => [
        [
          'url' => route('e-commerce.products'),
          'text' => trans('common.products')
        ], [
          'url' => '',
          'text' => $product['name_' . $lang]
        ]
      ]
    ], compact('lang', 'relatedProducts', 'newProducts', 'product'));
  }

  public function getProductPrice()
  {
    $product = Product::find($_GET['product_id']);
    $price = $product->price;
    if ($product->checkDiscount($product->price, $product->quantity) < $product->price) {
      $price = $product->checkDiscount($product->price, $product->quantity);
    }
    return $price;
  }
  public function getPriceAfterOption()
  {
    $product_option_value = ProductOptionItems::find($_GET['option_val']);
    $price = 0;
    if ($product_option_value != '') {
      // $product = Product::find($product_option_value['product_id']);
      $price = $product_option_value->price;
    }
    return $price;
  }
  public function productSearch(Request $request)
  {
    $lang = app()->getLocale();
    $output = '';
    $query = $request->get('query');
    if ($query != '') {
      $products = DB::table('products')
        ->where('name_' . $lang, 'LIKE', '%' . $query . '%')
        ->orWhere('description_' . $lang, 'LIKE', '%' . $query . '%')
        ->get();
      if ($products) {
        foreach ($products as $product) {
          $url = route('product.details', ['product' => $product->id]);
          if ($lang == "ar") {
            $output .= "<a class='man-section tt-suggestion tt-selectable'  href='" . $url . "'>"
              . "<div class='image-section'>
                <img src='" . asset('uploads/products/' . $product->id . '/' . $product->mainImage) . "'>
              </div>"
              . "<div class='description-section'><h4>" . $product->name_ar . "</h4>
                <span>" . $product->price . "</span>
                </div>"
              . "</a>";
          } else {
            $output .= "<a class='mb-5' href='" . $url . "'>" . $product->name_en . "</a>" .  "<br>";
          }
        }
      }
    }
    return Response($output);
  }
  public function productReview()
  {
    $rules = [
      'rating' => 'required|numeric|min:1|max:5',
      'content' => 'required|string',
    ];
    $this->validate(request(), $rules);
    try {
      $review = productReview::create([
        'product_id' => request('product_id'),
        'user_id' => auth()->user()->id,
        'rating' => request('rating'),
        'content' => request('content'),
      ]);
      if ($review) {
        return redirect()->back()->with('success', trans('common.commentSendSuccessfully'));
      } else {
        return redirect() - back()->with('failed', 'FailedToSendComment');
      }
    } catch (\Exception $e) {
      return redirect()->back()->with('failed', $e->getMessage());
    }
  }
}
