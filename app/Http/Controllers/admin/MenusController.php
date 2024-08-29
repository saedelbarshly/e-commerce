<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Termwind\Components\Dd;
use Response;

class MenusController extends Controller
{
    public function index()
    {
      $menus = Menu::orderBy('id', 'desc')->paginate(25);
      return view('AdminPanel.menus.index', [
        'active' => 'menus',
        'title' => trans('common.menus'),
        'breadcrumbs' => [
          [
            'url' => '',
            'text' => trans('common.menus')
          ]
        ]
      ], compact('menus'));
    }
    public function store(Request $request){
        $request->validate([
            'title_ar' => 'required',
            'title_en' => 'required',
            'place' => 'required',
        ]);
        $data = $request->except(['_token']);
        $menu = Menu::create($data);

        if($menu){
            return redirect()->route('admin.menus')
                            ->with('success','تم حفظ البيانات بنجاح');
        }else{
            return redirect()->back()
                            ->with('failed','لم نستطع حفظ البيانات');
        }
    }
    public function update(Request $request, Menu $menu)
    {
      $request->validate([
        'title_ar' => 'required',
        'title_en' => 'required',
        'place' => 'required',
      ]);
      $menu->update($request->except('_token'));
      if($menu){
          return redirect()->route('admin.menus')
                          ->with('success','تم تعديل البيانات بنجاح');
      }else{
          return redirect()->back()
                          ->with('failed','لم نستطع تعديل البيانات');
      }
    }
    public function delete(Menu $menu)
    {
      if ($menu->delete()) {
        return Response::json($menu->id);
      }else {
        return Response::json("false");
      }
    }
}
