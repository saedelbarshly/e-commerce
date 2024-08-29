<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Orders;
use App\Models\OrderItems;
use App\Models\Product;
use App\Models\UserPaymentMethods;
use Illuminate\Http\Response;
use App\Models\User;

class OrdersController extends Controller
{
    public function createOrder(Request $request)
    {
        $lang = $request->header('lang');
        $user = auth()->user();
        if (checkUserForApi($lang,$user->id) !== true) {
            return checkUserForApi($lang, $user->id);
        }
        $user = User::find($user->id);
        $rules = [
            'payment_method_id' => 'required'
        ];
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            foreach ((array)$validator->errors() as $error) {
                return response()->json([
                    'status' => 'faild',
                    'message' => trans('api.pleaseRecheckYourDetails'),
                    'data' => $error
                ]);
            }
        }
        $paymentMethod = UserPaymentMethods::where('id',$request->payment_method_id)->where('user_id', $user->id)->first();
        if ($paymentMethod == '') {
            return response()->json([
                'status' => false,
                'message' => trans('api.noPaymentMethodWithThisID'),
                'data' => ''
            ]);
        }

        if (isset(payForOrder($paymentMethod,$user)['status'])) {
            if (payForOrder($paymentMethod,$user)['status'] == 'succeeded') {
                $order = Orders::find($user->cart()['id']);
                $order->update([
                    'payment_method' => 'stripe',
                    'payment_method_id' => $request['payment_method_id'],
                    'shipping_total' => $request['shipping_total'],
                    'status' => 'done'
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' => '',
                    'data' => ''
                ]);
            } else {
                return response()->json([
                    'status' => 'faild',
                    'message' => payForOrder($paymentMethod,$user)['data'],
                    'data' => payForOrder($paymentMethod,$user)['data']
                ]);
            }
        } else {
            return response()->json([
                'status' => 'faild',
                'message' => '',
                'data' => ''
            ]);
        }
        return response()->json([
            'status' => 'faild',
            'message' => '',
            'data' => $user->cart()
        ]);
    }
    public function myOrdersList(Request $request)
    {
      $lang = $request->header('lang');
      $user = auth()->user();
        if (checkUserForApi($lang, $user->id) !== true) {
            return checkUserForApi($lang, $user->id);
        }
        $list = Orders::where('user_id',$user->id)->orderBy('id','desc')->get();
        $orders = [];
        foreach ($list as $key => $value) {
            $orders[] = $value->apiData($lang);
        }
        $resArr = [
            'status' => true,
            'data' => $orders
        ];
        return response()->json($resArr, Response::HTTP_OK);

    }
    public function OrderDetails(Request $request, $id)
    {
        $lang = $request->header('lang');
        $user = auth()->user();

        if (checkUserForApi($lang, $user->id) !== true) {
            return checkUserForApi($lang, $user->id);
        }
        $order = Orders::find($id);
        if ($order != '') {
            $resArr = [
                'status' => 'success',
                'message' => '',
                'data' => $order->apiData($lang)
            ];
        } else {
            $resArr = [
                'status' => 'faild',
                'message' => trans('api.someThingWentWrong'),
                'data' => []
            ];
        }
        return response()->json($resArr);

    }
    public function getShippingRate(Request $request)
    {
        $lang = $request->header('lang');
        $currency = $request->header('currency');
        $shippingMethod = $request->header('shippingMethod');
        $user = auth()->user();
        if ($shippingMethod == 'exprese') {
            $shippingMethod = 'aramex';
        }

        if (checkUserForApi($lang, $user->id) !== true) {
            return checkUserForApi($lang, $user->id);
        }

        $shipping_id = $request['shipping_id'];
        $resArr = [
            'status' => 'success',
            'data' => shippingCalculator($user->id,$shipping_id,$shippingMethod,$currency)
        ];
        return response()->json($resArr);

    }
    public function addToCart(Request $request)
    {
        $lang = $request->header('lang');
        $user = auth()->user();

        if (checkUserForApi($lang, $user->id) !== true) {
            return checkUserForApi($lang, $user->id);
        }
        $user = User::find($user->id);
        $items = [];
        foreach ($request['cart'] as $key => $value) {
            $items[] = [
                'product_id' => $value['product_id'],
                'quantity' => $value['quantity'],
                'price' => $value['price'],
            ];
        }

        addToCart($user->id,$items);
        $resArr = [
            'status' => 'success',
            'data' => $user->myCart($lang)
        ];
        return response()->json($resArr);

    }
    public function myCart(Request $request)
    {
        $lang = $request->header('lang');
        $currency = $request->header('currency');
        $user = auth()->user();

        if (checkUserForApi($lang, $user->id) !== true) {
            return checkUserForApi($lang, $user->id);
        }
        $user = User::find($user->id);
        $resArr = [
            'status' => true,
            'data' => $user->myCart($lang, $currency) != '' ? $user->myCart($lang,$currency) : ['id' => '']
        ];
        return response()->json($resArr);
    }
    public function removeCart(Request $request)
    {
        $lang = $request->header('lang');
        $user = auth()->user();

        if (checkUserForApi($lang, $user->id) !== true) {
            return checkUserForApi($lang, $user->id);
        }
        $user = User::find($user->id);
        $user->cart()->delete();
        $resArr = [
            'status' => 'success',
            'data' => $user->myCart($lang)
        ];
        return response()->json($resArr);

    }
    public function editCart(Request $request)
    {
        $lang = $request->header('lang');
        $user = auth()->user();

        if (checkUserForApi($lang, $user->id) !== true) {
            return checkUserForApi($lang, $user->id);
        }
        $user = User::find($user->id);
        $items = [];
        foreach ($request['cart'] as $key => $value) {
            $items[] = [
                'product_id' => $value['product_id'],
                'quantity' => $value['quantity'],
                'price' => $value['price'],
            ];
        }
        addToCart($user->id,$items);
        $resArr = [
            'status' => 'success',
            'data' => $user->myCart($lang)
        ];
        return response()->json($resArr);

    }
    public function removeItem(Request $request, $id)
    {
        $lang = $request->header('lang');
        $user = auth()->user();

        if (checkUserForApi($lang, $user->id) !== true) {
            return checkUserForApi($lang, $user->id);
        }
        $user = User::find($user->id);
        $item = OrderItems::find($id);
        if ($item != '') {
            $order = $item->subOrder;
            $item->delete();
            if ($order != '') {
                if ($order->items()->count() == 0) {
                    $order->delete();
                }
            }
        }
        $resArr = [
            'status' => 'success',
            'data' => $user->myCart($lang)
        ];
        return response()->json($resArr);

    }
    public function editItem(Request $request, $id)
    {
        $lang = $request->header('lang');
        $user_id = $request->header('user');

        if (checkUserForApi($lang, $user_id) !== true) {
            return checkUserForApi($lang, $user_id);
        }
        $user = User::find($user_id);
        $item = OrderItems::find($id);
        if ($item != '') {
            $quantity = $item->quantity;
            if ($request->action == 'increase') {
                $quantity += 1;
            } else {
                if ($quantity > 1) {
                    $quantity -= 1;
                }
            }
            $item->update(['quantity'=>$quantity,'total'=>$quantity*$item->price]);
        }
        $resArr = [
            'status' => 'success',
            'message' => '',
            'data' => $user->myCart($lang)
        ];
        return response()->json($resArr);

    }
    public function addCoupon(Request $request)
    {
        $lang = $request->header('lang');
        $user_id = $request->header('user');

        if (checkUserForApi($lang, $user_id) !== true) {
            return checkUserForApi($lang, $user_id);
        }
        $user = User::find($user_id);
        if ($user->cart() != '') {
            if (checkForCoupon($user->cart()['id'],$request->coupon) != '') {
                $resArr = [
                    'status' => 'success',
                    'message' => trans('common.yourCouponAddedSuccessfully'),
                    'data' => $user->myCart($lang)
                ];
            } else {
                $resArr = [
                    'status' => 'faild',
                    'message' => trans('common.canNotUseThisCoupon'),
                    'data' => $user->myCart($lang)
                ];
            }
        } else {
            $resArr = [
                'status' => 'faild',
                'message' => trans('api.someThingWentWrong'),
                'data' => $user->myCart($lang)
            ];
        }
        return response()->json($resArr);

    }
    public function removeCoupon(Request $request)
    {
        $lang = $request->header('lang');
        $user_id = $request->header('user');

        if (checkUserForApi($lang, $user_id) !== true) {
            return checkUserForApi($lang, $user_id);
        }
        $user = User::find($user_id);
        if ($user->cart() != '') {
            $order = Orders::find($user->cart()['id'])->update([
                'coupun_id' => '',
                'coupun_code' => ''
            ]);
            $resArr = [
                'status' => 'success',
                'message' => trans('common.yourCouponRemovedSuccessfully'),
                'data' => $user->myCart($lang)
            ];
        } else {
            $resArr = [
                'status' => 'faild',
                'message' => trans('api.someThingWentWrong'),
                'data' => $user->myCart($lang)
            ];
        }
        return response()->json($resArr);

    }
  
}
  
}
