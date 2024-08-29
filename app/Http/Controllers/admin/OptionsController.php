<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\optionTypes;
use App\Models\optionValue;
use Illuminate\Http\Request;
use Response;
class OptionsController extends Controller
{
  public function index()
  {
    $options = Option::with('optionType')->orderBy('ordering', 'desc')->paginate(10);
    $optionTypes = optionTypes::with('optionCategories')->orderBy('id', 'asc')->get();

    return view('AdminPanel.options.index', [
      'active' => 'options',
      'title' => trans('common.productsOptions'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.productsOptions')
        ]
      ]
    ], compact('options', 'optionTypes'));
  }
  public function create()
  {
    $optionTypes = optionTypes::with('optionCategories')->orderBy('id', 'asc')->get();
    return view('AdminPanel.options.create', [
      'active' => 'options',
      'title' => trans('common.productsOptions'),
      'breadcrumbs' => [
        [
          'url' => route('admin.options'),
          'text' => trans('common.productsOptions')
        ],
        [
          'url' => '',
          'text' => trans('common.CreateNew')
        ]
      ]
    ], compact('optionTypes'));
  }
  public function store(Request $request)
  {
    $role = [
      'name_ar' => 'required|string',
      'name_en' => 'required|string',
      'option_type_id' => 'required|numeric',
      'ordering' => 'nullable|numeric',
    ];
    $option = Option::create($request->validate($role));
    if (isset($_POST['option_name_ar'])) {
      for($i = 0; $i < count($_POST['option_name_ar']); $i++){
        $optionValue = optionValue::create([
          'name_ar' => $_POST['option_name_ar'][$i],
          'name_en' => $_POST['option_name_en'][$i],
          'option_id' => $option->id,
          'option_type_id' => $option->option_type_id,
          'ordering' => $_POST['option_ordering'][$i],
        ]);
      }
    }
    if ($option) {
      return redirect()->route('admin.options')
      ->with('success', 'تم حفظ البيانات بنجاح');
    } else {
      return redirect()->back()
        ->with('failed', 'لم نستطع حفظ البيانات');
    }
  }
  public function edit(Option $option)
  {
    $option->load('optionType', 'optionValues');
    $optionTypes = optionTypes::with('options')->pluck('name_'.app()->getLocale(), 'id');
    return view('AdminPanel.options.edit', [
      'active' => 'options',
      'title' => trans('common.productsOptions'),
      'breadcrumbs' => [
        [
          'url' => route('admin.options'),
          'text' => trans('common.productsOptions')
        ],
        [
          'url' => '',
          'text' => trans('common.edit')
        ]
      ]
    ], compact('option', 'optionTypes'));
  }
  public function update(Request $request, Option $option)
  {
    $role = [
      'name_ar' => 'required|string',
      'name_en' => 'required|string',
      'option_type_id' => 'required|numeric',
      'ordering' => 'nullable|numeric',
    ];
    $data = $option->update($request->validate($role));

    if (isset($_POST['option_name_ar'])) {
      $option->optionValues()->delete();
      for($i = 0; $i < count($_POST['option_name_ar']); $i++){
        $optionValue = optionValue::create([
          'name_ar' => $_POST['option_name_ar'][$i],
          'name_en' => $_POST['option_name_en'][$i],
          'option_id' => $option->id,
          'option_type_id' => $option->option_type_id,
          'ordering' => $_POST['option_ordering'][$i],
        ]);
      }
    }
    if ($data) {
      return redirect()->route('admin.options')
      ->with('success', 'تم تعديل البيانات بنجاح');
    } else {
      return redirect()->back()
        ->with('failed', 'لم نستطع تعديل البيانات');
    }
  }
  public function delete(Option $option)
  {
    if ($option->delete()) {
      return Response::json($option->id);
    } else {
      return Response::json("false");
    }
  }
}
