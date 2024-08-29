<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\productReview;
use Response;

class ReviewsController extends Controller
{
  public function index()
  {
    $reviews = productReview::orderBy('id', 'desc')->paginate(25);
    return view('AdminPanel.reviews.index', [
      'active' => 'reviews',
      'title' => trans('common.reviews'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.reviews')
        ]
      ]
    ], compact('reviews'));
  }


  public function status($id)
  {
    $productReview = productReview::find($id);
    if ($productReview->published == 0) {
      $productReview->published = 1;
    } else {
      $productReview->published = 0;
    }

    if ($productReview->update()) {
        return redirect()->back()
                        ->with('success',trans('common.successMessageText'));
    } else {
        return redirect()->back()
                        ->with('faild',trans('common.faildMessageText'));
    }
  }

  public function delete($id)
  {
    $productReview = productReview::find($id);
    if ($productReview->delete()) {
      return Response::json($id);
    } else {
      return Response::json("false");
    }
  }
}
