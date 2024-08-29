<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Specification;
use App\Models\specificationTypes;
use Illuminate\Http\Request;
use Response;

class SpecificationController extends Controller
{
  public function index()
  {
    $specifications = Specification::with('specificationTypes')->orderBy('ordering', 'desc')->paginate(10);
    $specificationTypes = specificationTypes::orderBy('ordering', 'desc')->get();
    return view('AdminPanel.specifications.index', [
      'active' => 'specifications',
      'title' => trans('common.productSpecifications'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.productSpecifications')
        ]
      ]
    ], compact('specifications', 'specificationTypes'));
  }

  public function store(Request $request)
  {
    $role = [
      'name_ar' => 'required|string',
      'name_en' => 'required|string',
      'specification_type_id' => 'required|numeric',
      'ordering' => 'nullable|numeric',
    ];
    $productSpecification = Specification::create($request->validate($role));
    if ($productSpecification) {
      return redirect()->route('admin.specifications')
      ->with('success', 'تم حفظ البيانات بنجاح');
    } else {
      return redirect()->back()
        ->with('failed', 'لم نستطع حفظ البيانات');
    }
  }
  public function update(Request $request, Specification $specification)
  {
    $role = [
      'name_ar' => 'required|string',
      'name_en' => 'required|string',
      'specification_type_id' => 'required|numeric',
      'ordering' => 'nullable|numeric',
    ];
    $specification = $specification->update($request->validate($role));
    if ($specification) {
      return redirect()->route('admin.specifications')
      ->with('success', 'تم تعديل البيانات بنجاح');
    } else {
      return redirect()->back()
        ->with('failed', 'لم نستطع تعديل البيانات');
    }
  }
  public function delete(Specification $specification)
  {
    if ($specification->delete()) {
      return Response::json($specification->id);
    } else {
      return Response::json("false");
    }
  }
}
