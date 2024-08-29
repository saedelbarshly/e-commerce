<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;

class registerController extends Controller
{
  public function index()
  {
    $lang = app()->getLocale();
    return view('frontend.register', [
      'title' => trans('common.register'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.register')
        ]
      ]
    ], compact('lang'));
  }
}
