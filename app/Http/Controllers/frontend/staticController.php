<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\FAQs;
use App\Models\Menu;
use App\Models\Pages;
use App\Models\Polices;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;

class staticController extends Controller
{
  public function index($id)
  {
    $lang = app()->getLocale();
    $page = Pages::find($id);
    return view('frontend.pages.index', [
      'title' => $page->title,
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => $page->title
        ]
      ]
    ], compact('lang', 'page'));
  }
  public function contact()
  {
    $lang = app()->getLocale();
    return view('frontend.contact.index', [
      'title' => trans('common.contactUs'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.contactUs')
        ]
      ]
    ], compact('lang'));
  }
  public function about()
  {
    $lang = app()->getLocale();
    return view('frontend.aboutUs.index', [
      'title' => trans('common.aboutUs'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.aboutUs')
        ]
      ]
    ], compact('lang'));
  }
  public function error()
  {
    $lang = app()->getLocale();
    return view('frontend.error.index', [
      'title' => trans('common.error'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.error')
        ]
      ]
    ], compact('lang'));
  }
  public function faqs()
  {
    $lang = app()->getLocale();
    $FAQs = FAQs::orderBy('ranking', 'asc')->get();
    return view('frontend.faqs.index', [
      'title' => trans('common.FAQs'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.FAQs')
        ]
      ]
    ], compact('lang', 'FAQs'));
  }

  public function polices()
  {
    $lang = app()->getLocale();
    $polices = Polices::orderBy('ranking', 'asc')->get();
    return view('frontend.polices.index', [
      'title' => trans('common.policesPrivacies'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.policesPrivacies')
        ]
      ]
    ], compact('lang', 'polices'));
  }
}
