<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\specificationTypes;
use Illuminate\Http\Request;
use Response;
class specificationTypesController extends Controller
{
  public function index()
  {
    $specificationTypes = specificationTypes::orderBy('ordering', 'desc')->paginate(25);
    return view('AdminPanel.specificationTypes.index', [
      'active' => 'specificationTypes',
      'title' => trans('common.specificationTypes'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.specificationTypes')
        ]
      ]
    ], compact('specificationTypes'));
  }

  public function store(Request $request)
  {
    $role = [
      'name_ar' => 'required|string',
      'name_en' => 'required|string',
      'ordering' => 'nullable|numeric',
    ];
    $type = specificationTypes::create($request->validate($role));
    if ($type) {
      return redirect()->route('admin.specificationTypes')
      ->with('success', 'تم حفظ البيانات بنجاح');
    } else {
      return redirect()->back()
        ->with('failed', 'لم نستطع حفظ البيانات');
    }
  }
  public function update(Request $request, specificationTypes $type)
  {
    $role = [
      'name_ar' => 'required|string',
      'name_en' => 'required|string',
      'ordering' => 'nullable|numeric',
    ];
    $type = $type->update($request->validate($role));
    if ($type) {
      return redirect()->route('admin.specificationTypes')
      ->with('success', 'تم تعديل البيانات بنجاح');
    } else {
      return redirect()->back()
        ->with('failed', 'لم نستطع تعديل البيانات');
    }
  }
  public function delete(specificationTypes $type)
  {

    if ($type->delete()) {
      return Response::json($type->id);
    } else {
      return Response::json("false");
    }
  }
}
