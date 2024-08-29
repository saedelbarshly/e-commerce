<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Menu;
use App\Models\orderAddress;
use App\Models\Orders;
use App\Models\User;
use App\Repositories\Cart\CartRepository;
use Illuminate\Http\Request;
use Symfony\Component\Intl\Countries;

class profileController extends Controller
{
  public function index()
  {
    $lang = app()->getLocale();
    $user = auth()->user();
    $user->load('myOrders');
    $userAddresses = $user->addresses()->get();
    $orders = $user->myOrders()->get();
    $wishlists = $user->wishlist()->get();
    $wishlists->load('product');
    return view('frontend.profile.index', [
      'title' => trans('common.profile'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.profile')
        ]
      ]
    ], compact('user', 'userAddresses', 'orders', 'wishlists', 'lang'));
  }
  public function edit()
  {
    $lang = app()->getLocale();
    $user = auth()->user();
    $countries = Countries::getNames($lang);
    return view('frontend.profile.edit', [
      'title' => trans('common.setting'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.setting')
        ]
      ]
    ], compact('lang', 'user', 'countries'));
  }
  public function update(Request $request)
  {
    $user = auth()->user();
    $data = $request->validate([
      'name' => 'required',
      'userName' => 'required',
      'email' => 'required|email|unique:users,email,' . auth()->id() . ',id',
      'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/',
      'address' => 'required',
      'country' => 'required',
      'city' => 'required',
      'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
    ]);
    if ($request->hasFile('photo')) {
      $data['photo'] = upload_image_without_resize('users/' . $user->id, $request->photo);
    }
    $update = $user->update($data);
    if ($update) {
      return redirect()->route('user.profile')->with('success', trans('common.ProfileUpdatedSuccessfully'));
    } else {
      return redirect()->back()->with('error', trans('common.SomethingWentWrong'));
    }
  }

  public function removeAddress(Request $request, $id)
  {
    $address = orderAddress::find($id);
    $address->delete();
    return redirect()->back();
  }
  public function myOrder($id)
  {
    $order = Orders::with(['address', 'items'])->find($id);
    $title = trans('common.orderDetails') . '#' . $id;
    return view('frontend.profile.order', compact('order', 'title'));
  }
  public function editPassword()
  {
    $user = auth()->user();
    return view('frontend.profile.editPassword', compact('user'));
  }
  // update password for current user only
  public function updatePassword(Request $request)
  {
    $user = auth()->user();
    $data = $request->validate([
      'password' => 'required|confirmed|min:6',
      'password_confirmation' => 'required'
    ]);
    $newPassword['password'] = bcrypt($data['password']);
    $update = $user->update($newPassword);
    if ($update) {
      return redirect()->route('user.profile')
        ->with('success', trans('common.successMessageText'));
    }
    return redirect()->back();
  }
}
