<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PublisherPaymentsHistory;

class PublisherPaymentsController extends Controller
{
    public function index(){

        $publisherspayments = PublisherPaymentsHistory::orderBy('id','desc')->paginate(25);
        return view('AdminPanel.publishersPayments.index', [
            'title' => trans('common.publisherspayments'),
            'active' => 'publisherspayments',
            'publisherspayments' => $publisherspayments,
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => trans('common.publisherspayments')
                ]
            ]
        ]);
    }

    public function store(Request $request){

        $data = $request->except(['_token','attachment']);

        $payment = PublisherPaymentsHistory::create($data);
        if ($request->attachment != '') {
            $payment['attachment'] = upload_image_without_resize('publishersPaymentsHistory/'.$payment->id , $request->attachment );
            $payment->update();
        }
        if ($payment) {
            return redirect()->route('admin.publisherspayments')
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }
    }

    public function update(Request $request, $id){

        $data = $request->except(['_token','attachment']);
        if ($request->attachment != '') {
            if ($user->attachment != '') {
                delete_image('publishersPaymentsHistory/'.$id , $user->attachment);
            }
            $update['attachment'] = upload_image_without_resize('publishersPaymentsHistory/'.$id , $request->attachment );
        }
        $update = PublisherPaymentsHistory::find($id)->update($data);
        if ($update) {
            return redirect()->route('admin.publisherspayments')
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }
    }

    public function delete($id){
        $payment_methods = PublisherPaymentsHistory::find($id);
        if ($payment_methods->delete()) {
            return Response::json($id);
        }
        return Response::json("false");
    }

}
