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
                                <th class="text-center">{{trans('common.name')}}</th>
                                <th class="text-center">{{trans('common.image')}}</th>
                                <th class="text-center">{{trans('common.ordering')}}</th>
                                <th class="text-center">{{trans('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse($categories as $category)
                            <tr id="row_{{$category->id}}">
                                <td>
                                    {{$category['name_ar']}}<br>
                                    {{$category['name_en']}}
                                </td>
                                <td class="text-center">
                                    <img src="{{ $category->photoLink() }}" alt="image" class="img-responsive rounded" width="100px" >
                                 </td>
                                <td class="text-center">
                                    {{$category->ordering}}
                                </td>
                                <td class="text-center">
                                    <a href="javascript:;" data-bs-target="#editcategory{{$category->id}}" data-bs-toggle="modal" class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.edit')}}">
                                        <i data-feather='edit'></i>
                                    </a>
                                    <?php $delete = route('admin.categories.delete',['category'=>$category->id]); ?>
                                    <button type="button" class="btn btn-icon btn-danger" onclick="confirmDelete('{{$delete}}','{{$category->id}}')" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.delete')}}">
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

                @foreach($categories as $category)
                    <div class="modal fade text-md-start" id="editcategory{{$category->id}}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body pb-5 px-sm-5 pt-50">
                                    <div class="text-center mb-2">
                                        <h1 class="mb-1">{{trans('common.edit')}}</h1>
                                    </div>
                                    {{Form::open(['url'=>route('admin.categories.update',['category'=>$category->id]), 'id'=>'editcategoryForm', 'class'=>'row gy-1 pt-75','files'=>true])}}
                                     <div class="col-12 col-md-6">
                                        <label class="form-label" for="name_ar">{{trans('common.name_ar')}}</label>
                                        {{Form::text('name_ar',$category->name_ar,['id'=>'name_ar', 'class'=>'form-control','required'])}}
                                      </div>
                                      <div class="col-12 col-md-6">
                                        <label class="form-label" for="name_en">{{trans('common.name_en')}}</label>
                                        {{Form::text('name_en',$category->name_en,['id'=>'name_en', 'class'=>'form-control'])}}
                                      </div>

                                      <div class="col-12 col-md-12">
                                        <label class="form-label" for="description_ar">{{trans('common.description_ar')}}</label>
                                        {{Form::textarea('description_ar',$category->description_ar,['id'=>'description_ar','class'=>'form-control','required', 'rows'=>3])}}
                                      </div>
                                      <div class="col-12 col-md-12">
                                        <label class="form-label" for="description_en">{{trans('common.description_en')}}</label>
                                        {{Form::textarea('description_en',$category->description_en,['id'=>'description_en','class'=>'form-control','required', 'rows'=>3])}}
                                      </div>
                                      <div class="col-12 col-md-12">
                                        <label class="form-label" for="keywords_ar">{{trans('common.keywords_ar')}}</label>
                                        {{Form::text('keywords_ar',$category->keywords_ar,['id'=>'keywords_ar','class'=>'form-control','required', 'rows'=>3])}}
                                      </div>
                                      <div class="col-12 col-md-12">
                                        <label class="form-label" for="keywords_en">{{trans('common.keywords_en')}}</label>
                                        {{Form::text('keywords_en',$category->keywords_en,['id'=>'keywords_en','class'=>'form-control','required', 'rows'=>3])}}
                                      </div>
                                      <div class="col-12 col-md-6">
                                        <label class="form-label" for="metadata_ar">{{trans('common.metadata_ar')}}</label>
                                        {{Form::text('metadata_ar',$category->metadata_ar,['id'=>'metadata_ar', 'class'=>'form-control','required'])}}
                                      </div>
                                      <div class="col-12 col-md-6">
                                        <label class="form-label" for="metadata_en">{{trans('common.metadata_en')}}</label>
                                        {{Form::text('metadata_en',$category->metadata_en,['id'=>'metadata_en', 'class'=>'form-control'])}}
                                      </div>
                                      <div class="col-12 col-md-12">
                                          <label class="repeater-title" for="primaryCategory">{{trans('common.primaryCategory')}}</label>
                                          <select class="form-select item-details" id="primaryCategory" name="parent_id">
                                            <option disabled>--إختيار القسم--</option>
                                            <option value="">لا يوجد قسم</option>
                                            @foreach($categories as $cat)
                                              @if($cat->id != $category->id)
                                                <option value="{{$cat->id}}" {{ ($cat->id == $category->parent_id) ? 'selected' :'' }} >
                                                  {{$cat->name_ar}}
                                                </option>
                                              @endif
                                            @endforeach
                                          </select>
                                      </div>
                                      <div class="col-12 col-md-6">
                                        <label class="form-label" for="status">الحالة</label>
                                        {{ Form::select('status', [
                                        'active' => 'تمكين',
                                        'inactive' => 'تعطيل',
                                        ],$category->status, ['id'=>'status', 'class'=>'form-control']) }}
                                      </div>
                                      <div class="col-12 col-md-6">
                                        <label class="form-label" for="ordering">{{trans('common.ordering')}}</label>
                                        {{Form::number('ordering',$category->ordering,['id'=>'ordering', 'step'=>'1', 'class'=>'form-control','required', 'min'=>0])}}
                                      </div>
                                      <div class="col-12 col-md-12">
                                        <label class="form-label" for="image">{{trans('common.image')}}</label>
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

                {{ $categories->links('vendor.pagination.default') }}

            </div>
        </div>
    </div>
    <!-- Bordered table end -->

@stop

@section('page_buttons')
    <a href="javascript:;" data-bs-target="#createcategory" data-bs-toggle="modal" class="btn btn-primary">
        {{trans('common.CreateNew')}}
    </a>
    <div class="modal fade text-md-start" id="createcategory" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">{{trans('common.CreateNew')}}</h1>
                    </div>
                    {{Form::open(['url'=>route('admin.categories.store'), 'id'=>'createcategoryForm', 'class'=>'row gy-1 pt-75', 'files'=>'true'])}}
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="name_ar">{{trans('common.name_ar')}}</label>
                            {{Form::text('name_ar','',['id'=>'name_ar', 'class'=>'form-control','required'])}}
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="name_en">{{trans('common.name_en')}}</label>
                            {{Form::text('name_en','',['id'=>'name_en', 'class'=>'form-control'])}}
                        </div>

                        <div class="col-12 col-md-12">
                          <label class="form-label" for="description_ar">{{trans('common.description_ar')}}</label>
                          {{Form::textarea('description_ar','',['id'=>'description_ar','class'=>'form-control','required', 'rows'=>3])}}
                        </div>
                        <div class="col-12 col-md-12">
                          <label class="form-label" for="description_en">{{trans('common.description_en')}}</label>
                          {{Form::textarea('description_en','',['id'=>'description_en','class'=>'form-control','required', 'rows'=>3])}}
                        </div>
                        <div class="col-12 col-md-12">
                          <label class="form-label" for="keywords_ar">{{trans('common.keywords_ar')}}</label>
                          {{Form::text('keywords_ar','',['id'=>'keywords_ar','class'=>'form-control','required', 'rows'=>3])}}
                        </div>
                        <div class="col-12 col-md-12">
                          <label class="form-label" for="keywords_en">{{trans('common.keywords_en')}}</label>
                          {{Form::text('keywords_en','',['id'=>'keywords_en','class'=>'form-control','required', 'rows'=>3])}}
                        </div>
                        <div class="col-12 col-md-12">
                          <label class="form-label" for="metadata_ar">{{trans('common.metadata_ar')}}</label>
                          {{Form::text('metadata_ar','',['id'=>'metadata_ar', 'class'=>'form-control','required'])}}
                        </div>
                        <div class="col-12 col-md-12">
                          <label class="form-label" for="metadata_en">{{trans('common.metadata_en')}}</label>
                          {{Form::text('metadata_en','',['id'=>'metadata_en', 'class'=>'form-control'])}}
                        </div>
                        <div class="col-12 col-md-12">
                          <label class="repeater-title" for="primaryCategory">{{trans('common.primaryCategory')}}</label>
                          <select class="form-select item-details" id="primaryCategory">
                            <option selected disabled>--إختيار القسم--</option>
                            <option value="">لا يوجد قسم</option>
                            @foreach($categories as $category)
                              <option value="{{$category->id}}">{{$category->name_ar}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="status">الحالة</label>
                          {{ Form::select('status', [
                          'active' => 'تمكين',
                          'inactive' => 'تعطيل',
                          ],'', ['id'=>'status', 'class'=>'form-control']) }}
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="ordering">{{trans('common.ordering')}}</label>
                          {{Form::number('ordering','',['id'=>'ordering', 'step'=>'1', 'class'=>'form-control','required', 'min'=>0])}}
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="image">{{trans('common.image')}}</label>
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
