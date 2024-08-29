<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Menu;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;

class blogController extends Controller
{
  public function index()
  {
    $blogs = Blog::all();
    $lang = app()->getLocale();
    return view('frontend.blog.index', [
      'title' => trans('common.blog'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.blog')
        ]
      ]
    ], compact('blogs', 'lang'));
  }
  public function show(Blog $blog)
  {
    $lang = app()->getLocale();
    return view('frontend.blog.details', [
      'title' => trans('common.blog'),
      'breadcrumbs' => [
        [
          'url' => route('e-commerce.blog'),
          'text' => trans('common.blog')
        ],
        [
          'url' => '',
          'text' => trans('common.blogDetails')
        ]
      ]
    ], compact('blog', 'lang'));
  }
}
