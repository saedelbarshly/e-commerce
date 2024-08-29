<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\ContactMessages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class contactController extends Controller
{

  public function storeMessage(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255',
      'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
      'address' => 'required',
      'content' => 'required|string|max:255',
    ]);
    if (!$validator->passes()) {
      return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
    } else {
      $value = [
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'content' => $request->content,
      ];

      $message = ContactMessages::create($value);
      $message->save();
      return response()->json(['status' => 1, 'msg' => 'Thank you for your message. We will contact you soon.']);
    }
  }
}
