<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\StoreCompanyRequest;
use App\Models\Companies;
use Illuminate\Http\Request;
use File;
use Response;
class CompaniesController extends Controller
{
  public function index()
  {
    $companies = Companies::orderBy('ordering', 'desc')->paginate(25);
    return view('AdminPanel.companies.index', [
      'active' => 'companies',
      'title' => trans('common.companies'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.companies')
        ]
      ]
    ], compact('companies'));
  }

  public function store(StoreCompanyRequest $request)
  {
    // dd($request->all());
    $data = $request->except(['_token', 'image']);
    $company = Companies::create($data);
    if ($request->image != '') {
      $company['image'] = upload_image_without_resize('companies/' . $company->id, $request->image);
      $company->update();
    }
    if ($company) {
      return redirect()->back()
        ->with('success', trans('common.successMessageText'));
    } else {
      return redirect()->back()
        ->with('faild', trans('common.faildMessageText'));
    }
  }
  public function update(Request $request, $id)
  {
    $company = Companies::find($id);
    $data = $request->except(['_token', 'image']);
    if ($request->image != '') {
      if ($company->image != '' || file_exists(public_path('uploads/companies/' . $company->id . '/' . $company->image))) {
        unlink(public_path('uploads/companies/' . $company->id . '/' . $company->image));
      }
      $data['image'] = upload_image_without_resize('companies/' . $company->id, $request->image);
    }
    $company->update($data);
    if ($company) {
      return redirect()->route('admin.companies')
        ->with('success', 'تم تعديل البيانات بنجاح');
    } else {
      return redirect()->back()
        ->with('failed', 'لم نستطع تعديل البيانات');
    }
  }

  public function delete($id)
  {
    $company = Companies::find($id);
    if ($company->image != '' && file_exists(public_path('uploads/companies/' . $company->id . '/' . $company->image))) {
      File::deleteDirectory(public_path('uploads/companies/' . $company->id),);
    }
    if ($company->delete()) {
      return Response::json($id);
    }
    return Response::json("false");
  }
}
