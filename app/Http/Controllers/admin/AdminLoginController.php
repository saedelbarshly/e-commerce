<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
      $title = trans('common.e-commerce');
      return view('AdminPanel.auth.login', [
        'active' => '',
        'title' => $title,
      ], compact('title'));
    }
}
