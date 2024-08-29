<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class dashboardController extends Controller
{
  public function index()
  {
    return view('frontend.dashboard.index', [
      'title' => "dashboard",
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => "dashboard"
        ]
      ]
    ]);
  }}
