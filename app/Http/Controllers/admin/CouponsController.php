<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupons;
use Illuminate\Support\Facades\Validator;
use Response;

class CouponsController extends Controller
{
    public function index()
    {
        $coupons = Coupons::orderBy('id','asc')->withCount('invoices')->paginate(25);
        return view('AdminPanel.coupons.index', [
            'active' => 'coupons',
            'title' => trans('common.coupons'),
            'coupons' => $coupons,
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => 'إدارة قسائم الشراء'
                ]
            ],
        ]);
    }
    public function store(Request $request)
    {
        $rules = [
            'coupon' => 'required',
            'percentage' => 'required_without:amount',
            'amount' => 'required_without:percentage',
            'max_date' => 'required',
            'max_clients' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator ->fails()){
            return redirect()->back()->withErrors($validator)->withInput($request->all());
        }
        $data = $request->except(['_token']);

        $coupon = Coupons::create($data);
        if ($coupon) {
            return redirect()->route('admin.coupons.index')->with([
                'success'=>'تم إنشاء القسيمة بنجاح',
                'Active' => 'coupons',
            ]);
        }
        return redirect()->back()->with(['failed'=>'لم تتم العملية بنجاح يرجى التواصل مع الدعم الفنى بخصوص ذلك!']);
    }

    public function destroy($id)
    {
        $user = Coupons::find($id);
        if ($user->delete()) {
            return Response::json($id);
        }
        return Response::json("false");
    }
}
