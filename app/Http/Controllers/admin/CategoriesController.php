<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\StoreCategoryRequest;
use App\Http\Requests\admin\UpdateCategoryRequest;
use App\Models\Categories;
use File;
use Illuminate\Http\Request;
use Response;

class CategoriesController extends Controller
{
  public function index()
  {
    $categories = Categories::orderBy('ordering', 'desc')->paginate(25);
    return view('AdminPanel.categories.index', [
      'active' => 'categories',
      'title' => trans('common.categories'),
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => trans('common.categories')
        ]
      ]
    ], compact('categories'));
  }

  public function store(StoreCategoryRequest $request)
  {
      $category = Categories::create($request->validated());
      if ($request->hasFile('image')) {
        $category['image'] = upload_image_without_resize('categories/' . $category->id, $request->image);
        $category->update();
      }
      if ($category) {
        return redirect()->route('admin.categories')
        ->with('success', 'تم حفظ البيانات بنجاح');
      } else {
        return redirect()->back()
          ->with('failed', 'لم نستطع حفظ البيانات');
      }
  }
  public function update(UpdateCategoryRequest $request, Categories $category)
  {
    $category->update($request->except('_token', 'image'));
    if ($request->hasFile('image')) {
      unlink('uploads/categories/' . $category->id . '/' . $category->image);
      $category['image'] = upload_image_without_resize('categories/' . $category->id, $request->image);
      $category->update();
    }
    if ($category) {
      return redirect()->route('admin.categories')
      ->with('success', 'تم تعديل البيانات بنجاح');
    } else {
      return redirect()->back()
        ->with('failed', 'لم نستطع تعديل البيانات');
    }
  }
  public function delete(Categories $category)
  {
    if ($category->image != '') {
      File::deleteDirectory(public_path('uploads/categories/' . $category->id),);
    }
    if($category->items != '') {
      $category->items()->delete();
    }
    if ($category->delete()) {
      return Response::json($category->id);
    } else {
      return Response::json("false");
    }
  }
}
