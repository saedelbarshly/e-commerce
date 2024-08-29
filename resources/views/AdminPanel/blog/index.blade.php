@extends('AdminPanel.layouts.master')
@section('content')


<!-- Bordered table start -->
<div class="row" id="table-bordered">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">{{$title}}</h4>
      </div>
      <div>
        @if ($errors->any())
        <div class="alert alert-danger">
          <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
        @endif
      </div>
      <div class="table-responsive">
        <table class="table table-bordered mb-2">
          <thead class="text-center">
            <tr>
              <th>العنوان</th>
              <th class="text-center">الوصف</th>
              <th class="text-center">الصورة</th>
              <th class="text-center">الإجراءات</th>
            </tr>
          </thead>
          <tbody class="text-center">
            @forelse($blogs as $blog)
            <tr id="row_{{ $blog->id }}">
              <td>
                {{$blog['title_ar']}}<br>
                {{$blog['title_en']}}
              </td>
              <td class="text-center" style="max-width: 300px;overflow: hidden;text-overflow: ellipsis;white-space: nowrap;">
                {{$blog->description_ar}}<br>
                {{$blog->description_en}}
              </td>
              <td class="text-center">
                <img src="{{$blog->photoLink()}}" alt="" width="100px" class="rounded">
              </td>
              <td class="text-center">
                <a href="javascript:;" data-bs-target="#editblog{{$blog->id}}" data-bs-toggle="modal"
                  class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top"
                  data-bs-original-title="{{trans('common.edit')}}">
                  <i data-feather='edit'></i>
                </a>
                <?php $delete = route('admin.blogs.delete',['blog'=>$blog->id]); ?>
                <button type="button" class="btn btn-icon btn-danger"
                  onclick="confirmDelete('{{$delete}}','{{$blog->id}}')" data-bs-toggle="tooltip"
                  data-bs-placement="top" data-bs-original-title="{{trans('common.delete')}}">
                  <i data-feather='trash-2'></i>
                </button>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5" class="p-3 text-center ">
                <h2>{{trans('common.nothingToView')}}</h2>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
      @foreach($blogs as $blog)
      <div class="modal fade text-md-start" id="editblog{{$blog->id}}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
          <div class="modal-content">
            <div class="modal-header bg-transparent">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
              <div class="text-center mb-2">
                <h1 class="mb-1">تعديل</h1>
              </div>
              {{Form::open(['url'=>route('admin.blogs.update',['blog'=>$blog->id]), 'id'=>'editblogForm', 'class'=>'row
              gy-1 pt-75','files'=>'true'])}}
              <div class="col-12 col-md-6">
                <label class="form-label" for="title_ar">العنوان بالعربية</label>
                {{Form::text('title_ar',$blog->title_ar,['id'=>'title_ar', 'class'=>'form-control'])}}
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label" for="title_en">العنوان بالإنجليزية</label>
                {{Form::text('title_en',$blog->title_en,['id'=>'title_en', 'class'=>'form-control'])}}
              </div>
              <div class="col-12 col-md-12">
                <label class="form-label" for="description_ar">الوصف بالعربية</label>
                {{Form::textarea('description_ar',$blog->description_ar,['id'=>'description_ar',
                'class'=>'form-control editor_ar','rows'=>3 ])}}
              </div>
              <div class="col-12 col-md-12">
                <label class="form-label" for="description_en">الوصف بالإنجليزية</label>
                {{Form::textarea('description_en',$blog->description_en,['id'=>'description_en',
                'class'=>'form-control editor_en', 'rows'=>3])}}
              </div>
              
              <div class="col-12 col-md-6">
                <label class="form-label" for="focus_keyword">الكلمة الدليلية المستهدفة</label>
                {{Form::text('focus_keyword',$blog->focus_keyword,['id'=>'focus_keyword', 'class'=>'form-control'])}}
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label" for="keywords">الكلمات الدليلية</label>
                {{Form::text('keywords',$blog->keywords,['id'=>'keywords', 'class'=>'form-control'])}}
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label" for="meta_description">وصف الميتا</label>
                {{Form::text('meta_description',$blog->meta_description,['id'=>'meta_description', 'class'=>'form-control'])}}
              </div>
              <div class="col-12 col-md-12">
                <label class="form-label" for="image">الصورة</label>
                {{Form::file('image',['id'=>'image', 'class'=>'form-control'])}}
              </div>
              <div class="col-12 text-center mt-2 pt-50">
                <button type="submit" class="btn btn-primary me-1">{{trans('common.Save changes')}}</button>
                <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                  {{trans('common.Cancel')}}
                </button>
              </div>
              {{Form::close()}}
            </div>
          </div>
        </div>
      </div>
      @endforeach
      {{ $blogs->links('vendor.pagination.default') }}
    </div>
  </div>
</div>
<!-- Bordered table end -->



@stop

@section('page_buttons')
<a href="javascript:;" data-bs-target="#createblog" data-bs-toggle="modal" class="btn btn-primary">
  إضافة جديد
</a>

<div class="modal fade text-md-start" id="createblog" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
    <div class="modal-content">
      <div class="modal-header bg-transparent">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body pb-5 px-sm-5 pt-50">
        <div class="text-center mb-2">
          <h1 class="mb-1">{{trans('common.CreateNew')}}</h1>
        </div>
        {{Form::open(['url'=>route('admin.blogs.store'), 'id'=>'createblogForm', 'class'=>'row gy-1 pt-75',
        'files'=>'true'])}}
        <div class="col-12 col-md-6">
          <label class="form-label" for="title_ar">العنوان بالعربية</label>
          {{Form::text('title_ar','',['id'=>'title_ar', 'class'=>'form-control'])}}
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label" for="title_en">العنوان بالإنجليزية</label>
          {{Form::text('title_en','',['id'=>'title_en', 'class'=>'form-control'])}}
        </div>
        <div class="col-12 col-md-12">
          <label class="form-label" for="description_ar">الوصف بالعربية</label>
          {{Form::textarea('description_ar','',['id'=>'description_ar', 'class'=>'form-control editor_ar', 'rows'=>3])}}
        </div>
        <div class="col-12 col-md-12">
          <label class="form-label" for="description_en">الوصف بالإنجليزية</label>
          {{Form::textarea('description_en','',['id'=>'description_en', 'class'=>'form-control editor_en', 'rows'=>3])}}
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label" for="focus_keyword">الكلمة الدليلية المستهدفة</label>
          {{Form::text('focus_keyword','',['id'=>'focus_keyword', 'class'=>'form-control'])}}
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label" for="keywords">الكلمات الدليلية</label>
          {{Form::text('keywords','',['id'=>'keywords', 'class'=>'form-control'])}}
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label" for="meta_description">وصف الميتا</label>
          {{Form::text('meta_description','',['id'=>'meta_description', 'class'=>'form-control'])}}
        </div>
        <div class="col-12 col-md-12">
          <label class="form-label" for="image">الصورة</label>
          {{Form::file('image',['id'=>'image', 'class'=>'form-control'])}}
        </div>
        <div class="col-12 text-center mt-2 pt-50">
          <button type="submit" class="btn btn-primary me-1">{{trans('common.Save changes')}}</button>
          <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
            {{trans('common.Cancel')}}
          </button>
        </div>
        {{Form::close()}}
      </div>
    </div>
  </div>
</div>
@stop
