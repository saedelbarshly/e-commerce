<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Items;
use App\Models\Menu;
use App\Models\Pages;
use Illuminate\Http\Request;
use Response;

class ItemsController extends Controller
{
  public function index(Menu $menu)
  {
    $items = Items::where('menu_id', $menu->id)->paginate(25);
    $mainItems = Items::where('menu_id', $menu->id)->where('mainElement',0)->pluck('title_' . app()->getLocale(), 'id')->all();
    $categories = Categories::pluck('name_' . app()->getLocale(), 'id')->toArray();
    $pages = Pages::pluck('title_' . app()->getLocale(), 'id')->toArray();
    return view('AdminPanel.items.index', [
      'active' => 'menus',
      'title' => $menu['title_' . app()->getLocale()],
      'breadcrumbs' => [
        [
          'url' => route('admin.menus'),
          'text' => trans('common.menus')
        ],
        [
          'url' => '',
          'text' => $menu['title_' . app()->getLocale()]
        ]
      ],
    ], compact('items', 'menu', 'categories', 'pages', 'mainItems'));
  }
  public function store(Request $request, Menu $menu)
  {
    $request->validate([
      'title_ar' => 'required',
      'title_en' => 'required',
      'type' => 'required',
      'mainElement' => 'required_if:type,category,staticPage',
      'link' => 'required_if:type,link',
    ]);
    $data = $request->except(['_token']);
    $data['menu_id'] = $menu->id;
    $item = Items::create($data);
    if ($item) {
      return redirect()->route('admin.items', ['menu' => $menu->id])
        ->with('success', 'تم حفظ البيانات بنجاح');
    } else {
      return redirect()->back()
        ->with('failed', 'لم نستطع حفظ البيانات');
    }
  }
  public function update(Request $request,Menu $menu,Items $item)
  {
    $request->validate([
      'title_ar' => 'required',
      'title_en' => 'required',
      'type' => 'required',
      'mainElement' => 'required_if:type,category,staticPage',
      'link' => 'required_if:type,link',
    ]);
    $item->update($request->except('_token'));
    if ($item) {
      return redirect()->route('admin.items', ['menu' => $menu->id])
        ->with('success', 'تم تعديل البيانات بنجاح');
    } else {
      return redirect()->back()
        ->with('failed', 'لم نستطع تعديل البيانات');
    }
  }
  public function delete(Menu $menu,Items $item)
  {
    if ($item->delete()) {
      return Response::json($item->id);
    } else {
      return Response::json("false");
    }
  }
}
