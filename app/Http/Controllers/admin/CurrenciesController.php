<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\StoreCurrencyRequest;
use App\Models\Currencies;
use Illuminate\Http\Request;
use Response;

class CurrenciesController extends Controller
{
    public function index()
    {
        $currencies = Currencies::orderBy('name_'.session()->get('Lang'),'desc')->paginate(25);
        return view('AdminPanel.currencies.index',[
            'active' => 'currencies',
            'title' => trans('common.currencies'),
            'currencies' => $currencies,
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => trans('common.currencies')
                ]
            ]
        ]);
    }

    public function store(StoreCurrencyRequest $request)
    {
        $data = $request->except(['_token']);
        $currency = Currencies::create($data);
        if($request->primary){
            $currencies = Currencies::where('id','!=',$currency->id)->get();
            foreach($currencies as $old_currency){
                $old_currency->primary = 0;
                $old_currency->save();
            }
        }
        if ($currency) {
            return redirect()->back()
                            ->with('success',trans('common.successMessageText'));
        } else {
            return redirect()->back()
                            ->with('faild',trans('common.faildMessageText'));
        }

    }

    public function update(StoreCurrencyRequest $request, $id)
    {
        $data = $request->except(['_token']);
        if(!$request->primary){
            $data['primary'] = 0;
        }else{
            $currencies = Currencies::where('id','!=',$id)->get();
            foreach($currencies as $old_currency){
                $old_currency->primary = 0;
                $old_currency->save();
            }
        }
        $update = Currencies::find($id)->update($data);
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
      $currency = Currencies::find($id);
      if($currency->primary == 1){
        return Response::json("false");
      }else if($currency->primary == 0){
        $currency->delete();
        return Response::json($id);
      }else{
        return Response::json("false");
      }
    }

}
