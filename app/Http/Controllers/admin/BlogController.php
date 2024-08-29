<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Response;
use App\Models\Blog;
use File;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;

class BlogController extends Controller
{
  public function index()
  {
    $blogs = Blog::orderBy('id', 'desc')->paginate(6);
    return view('AdminPanel.blog.index', [
      'active' => 'blogs',
      'title' => 'المدونة',
      'breadcrumbs' => [
        [
          'url' => '',
          'text' => 'المدونة'
        ]
      ]
    ], compact('blogs'));
  }
  public function store(StoreBlogRequest $request)
  {
    $blog = Blog::create($request->validated());
    if ($request->hasFile('image')) {
      $blog['image'] = upload_image_without_resize('blogs/' . $blog->id, $request->image);
      $blog->update();
    }
    if ($blog) {
      return redirect()->route('admin.blogs')
        ->with('success', 'تم حفظ البيانات بنجاح');
    } else {
      return redirect()->back()
        ->with('failed', 'لم نستطع حفظ البيانات');
    }
  }
  public function update(UpdateBlogRequest $request, Blog $blog)
  {
    $blog->update($request->except('_token', 'image'));
    if ($request->hasFile('image')) {
      if ($blog->image != '') {
        File::deleteDirectory(public_path('uploads/blogs/' . $blog->id),);
      }
      // unlink('uploads/blogs/' . $blog->id . '/' . $blog->image);
      $blog['image'] = upload_image_without_resize('blogs/' . $blog->id, $request->image);
      $blog->update();
    }
    if ($blog) {
      return redirect()->route('admin.blogs')
        ->with('success', 'تم تعديل البيانات بنجاح');
    } else {
      return redirect()->back()
        ->with('failed', 'لم نستطع تعديل البيانات');
    }
  }
  public function delete(Blog $blog)
  {
    if ($blog->image != '') {
      File::deleteDirectory(public_path('uploads/blogs/' . $blog->id),);
    }
    if ($blog->delete()) {
      return Response::json($blog->id);
    } else {
      return Response::json("false");
    }
  }
}
