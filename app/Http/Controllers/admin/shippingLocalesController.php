<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ShippingLocales;
use Response;

class shippingLocalesController extends Controller
{

    public function index()
    {
        $ShippingLocales = ShippingLocales::orderBy('id','desc')->paginate(25);
        return view('AdminPanel.shippingLocales.index',[
            'active' => 'ShippingLocales',
            'title' => trans('common.shippingLocales'),
            'ShippingLocales' => $ShippingLocales,
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => trans('common.shippingLocales')
                ]
            ]
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'from_country' => 'required',
            'to_country' => 'required',
            'from_city' => 'required',
            'to_city' => 'required',
            'price' => 'required'
        ];
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)
                            ->with('faild',trans('api.pleaseRecheckYourDetails'));
        }

        $data = $request->except(['_token']);

        $shipping = ShippingLocales::create($data);
        if ($shipping) {
            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }

    public function update(Request $request, $id)
    {
        $rules = [
            'from_country' => 'required',
            'to_country' => 'required',
            'from_city' => 'required',
            'to_city' => 'required',
            'price' => 'required'
        ];
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)
                            ->with('faild',trans('api.pleaseRecheckYourDetails'));
        }
        $page = ShippingLocales::find($id);
        $data = $request->except(['_token']);

        $update = ShippingLocales::find($id)->update($data);
        if ($update) {
            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }

    public function delete($id)
    {
        $page = ShippingLocales::find($id);
        if ($page->delete()) {
            return Response::json($id);
        }
        return Response::json("false");
    }
}
