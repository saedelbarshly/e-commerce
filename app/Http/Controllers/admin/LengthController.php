<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\LengthStoreRequest;
use App\Models\Length;
use Illuminate\Http\Request;
use Response;

class LengthController extends Controller
{
  public function index()
  {
    $length = Length::orderBy('title_' . session()->get('Lang'), 'desc')->paginate(25);
    return view('AdminPanel.length.index', [
      'active' => 'length',
      'title' => trans('common.length'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.length')
        ]
      ]
    ], compact('length'));
  }

  public function store(LengthStoreRequest $request)
  {
    $data = $request->except(['_token']);
    $len = Length::create($data);
    if ($request->primary) {
      $Len = Length::where('id', '!=', $len->id)->get();
      foreach ($Len as $old_Len) {
        $old_Len->primary = 0;
        $old_Len->save();
      }
    }
    if ($len) {
      return redirect()->back()
        ->with('success', trans('common.successMessageText'));
    } else {
      return redirect()->back()
        ->with('faild', trans('common.faildMessageText'));
    }
  }
  public function update(LengthStoreRequest $request, $id)
  {
    $data = $request->except(['_token']);
    if (!$request->primary) {
      $data['primary'] = 0;
    } else {
      $len = Length::where('id', '!=', $id)->get();
      foreach ($len as $old_len) {
        $old_len->primary = 0;
        $old_len->save();
      }
    }
    $update = Length::find($id)->update($data);
    if ($update) {
      return redirect()->back()
        ->with('success', trans('common.successMessageText'));
    } else {
      return redirect()->back()
        ->with('faild', trans('common.faildMessageText'));
    }
  }
  public function delete($id)
  {
    $len = Length::find($id);
    if ($len->primary == 1) {
      return Response::json("false");
    } else if ($len->primary == 0) {
      $len->delete();
      return Response::json($id);
    } else {
      return Response::json("false");
    }
  }
}
