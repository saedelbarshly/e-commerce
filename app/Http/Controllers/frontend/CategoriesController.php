<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Companies;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
  public function index()
  {
    $lang = app()->getLocale();
    $rightFooter = Menu::with('items')->where('place', 'footer2')->get();
    $leftFooter = Menu::with('items')->where('place', 'footer1')->get();
    $navItems = Menu::with('items')->where('place', 'header')->get();
    $companies = Companies::pluck('name_' . $lang, 'id');
    $AllCategories = Categories::pluck('name_' . $lang, 'id');
    // $categories = Categories::with('products')->orderBy('name_' . $lang);
    // if (isset($_GET['category_id'])) {
    //   $categories = $categories->where('id', $_GET['category_id']);
    // }
    // $categories = $categories->pi;
    $products = Product::orderBy('id', 'asc');
    if (isset($_GET['category_id'])) {
      $products = $products->where('category_id', $_GET['category_id']);
    }
    if (isset($_GET['brand_id'])) {
      $products = $products->whereIn('brand_id', $_GET['brand_id']);
    }
    $products = $products->paginate(16);
    return view('frontend.categories.index', [
      'title' => trans('common.categories'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.categories')
        ]
      ]
    ], compact('categories', 'lang', 'rightFooter', 'leftFooter', 'navItems','companies', 'AllCategories', 'products'));
  }
  //show category
  public function show(Categories $category){
    $lang = app()->getLocale();
    $rightFooter = Menu::with('items')->where('place', 'footer2')->get();
    $leftFooter = Menu::with('items')->where('place', 'footer1')->get();
    $navItems = Menu::with('items')->where('place', 'header')->get();
    $categories = Categories::orderBy('name_' . $lang);
    if (isset($_GET['category_id'])) {
      $categories = $categories->where('id', $_GET['category_id']);
    }
    $categories = $categories->get();
    return view('frontend.categories.show', [
      'title' => trans('common.categories'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.categories')
        ],
        [
          'url' => '',
          'text' => $category['name_' . $lang]
        ]
      ]
    ], compact('category', 'lang', 'rightFooter', 'leftFooter', 'navItems'));
  }

}
