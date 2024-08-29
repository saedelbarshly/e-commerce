<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Orders;

class OrdersController extends Controller
{

    public function index()
    {
        $orders = Orders::with('address')->orderBy('id','desc');
        if (isset($_GET['client_id'])) {
            if ($_GET['client_id'] != '') {
                $orders = $orders->where('user_id',$_GET['client_id']);
            }
        }
        if (isset($_GET['order_id'])) {
            if ($_GET['order_id'] != '') {
                $orders = $orders->where('id',$_GET['order_id']);
            }
        }
        if (isset($_GET['from_date'])) {
            if ($_GET['from_date'] != '') {
                $orders = $orders->where('date_time_str','>=',strtotime($_GET['from_date']));
            }
        }
        if (isset($_GET['to_date'])) {
            if ($_GET['to_date'] != '') {
                $orders = $orders->where('date_time_str','<=',strtotime($_GET['to_date']));
            }
        }
        $orders = $orders->paginate(20);
        return view('AdminPanel.orders.index', [
            'title' => trans('common.orders'),
            'active' => 'orders',
            'orders' => $orders,
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => trans('common.orders')
                ]
            ]
        ]);
    }
    public function details($id)
    {

        $order = Orders::with('address')->find($id);

        return view('AdminPanel.orders.details', [
            'title' => trans('common.orders'),
            'active' => 'order',
            'order' => $order,
            'breadcrumbs' => [
                [
                    'url' => route('admin.orders'),
                    'text' => trans('common.orders')
                ],
                [
                    'url' => '',
                    'text' => trans('common.order').': #'.$id
                ]
            ]
        ]);
    }
}
