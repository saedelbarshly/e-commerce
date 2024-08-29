<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\FAQs;
use Response;

class FAQsController extends Controller
{
    public function index()
    {
        $faqs = FAQs::orderBy('id','desc')->paginate(25);
        return view('AdminPanel.FAQs.index',[
            'active' => 'faqs',
            'title' => trans('common.FAQs'),
            'faqs' => $faqs,
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => trans('common.FAQs')
                ]
            ]
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'question_ar' => 'required',
            'answer_ar' => 'required'
        ];
        $validator=Validator::make($request->all(),$rules);
        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)
                            ->with('faild',trans('api.pleaseRecheckYourDetails'));
        }

        $data = $request->except(['_token']);

        $section = FAQs::create($data);
        if ($section) {
            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }

    public function update(Request $request, $id)
    {
        $section = FAQs::find($id);
        $data = $request->except(['_token']);

        $update = FAQs::find($id)->update($data);
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
        $section = FAQs::find($id);
        if ($section->delete()) {
            return Response::json($id);
        }
        return Response::json("false");
    }
}
