<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Response;
class SubscribeController extends Controller
{
  public function index()
  {
    $messages = Subscribe::orderBy('status', 'asc')->orderByDesc('created_at')->paginate(20);
    return view('AdminPanel.subscribe.index', [
      'active' => 'subscribe',
      'title' => trans('common.subscribeMessages'),
      'messages' => $messages,
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.subscribeMessages')
        ]
      ]
    ]);
  }

  public function delete($id)
  {
    $message = Subscribe::find($id);
    if ($message->delete()) {
      return Response::json($id);
    }
    return Response::json("false");
  }

  public function store(Request $request)
  {
    $rules = [
      'email' => 'required|email|unique:subscribes,email'
    ];
    $validator = Validator::make($request->all(), $rules);
    if($validator->fails()) {
      return Response::json(["error"=> $validator->errors()]);
    }
    $message = new Subscribe();
    $message->email = $request->email;
    $message->status = 1;
    if ($message->save()) {
      return Response::json($message);
    }
    return Response::json("false");
  }
}
