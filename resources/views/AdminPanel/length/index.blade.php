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
                                <th>{{trans('common.lengthTitle')}}</th>
                                <th class="text-center">{{trans('common.type')}}</th>
                                <th class="text-center">{{trans('common.lengthUnit')}}</th>
                                <th class="text-center">{{trans('common.Value')}}</th>
                                <th class="text-center">{{trans('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse($length as $len)
                            <tr id="row_{{$len->id}}">
                                <td>
                                    {{$len['title_ar']}}<br>
                                    {{$len['title_en']}}
                                </td>
                                <td class="text-center">
                                    {{ ($len->primary == 1) ? 'إفتراضي' : '-' }}
                                </td>
                                <td class="text-center">
                                    {{$len->unit_length_ar}}<br>
                                    {{$len->unit_length_en}}
                                </td>
                                <td class="text-center">
                                        {{$len->value}}
                                </td>
                                <td class="text-center">
                                    <a href="javascript:;" data-bs-target="#editlen{{$len->id}}" data-bs-toggle="modal" class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.edit')}}">
                                        <i data-feather='edit'></i>
                                    </a>
                                    <?php $delete = route('admin.length.delete',['id'=>$len->id]); ?>
                                    <button type="button" class="btn btn-icon btn-danger" onclick="confirmDelete('{{$delete}}','{{$len->id}}')" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.delete')}}">
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

                @foreach($length as $len)
                    <div class="modal fade text-md-start" id="editlen{{$len->id}}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body pb-5 px-sm-5 pt-50">
                                    <div class="text-center mb-2">
                                        <h1 class="mb-1">{{trans('common.edit')}}</h1>
                                    </div>
                                    {{Form::open(['url'=>route('admin.length.update',['id'=>$len->id]), 'id'=>'editlenForm', 'class'=>'row gy-1 pt-75'])}}
                                        <div class="col-12 col-md-6">
                                            <label class="form-label" for="title_ar">{{trans('common.title_ar')}}</label>
                                            {{Form::text('title_ar',$len->title_ar,['id'=>'title_ar', 'class'=>'form-control','required'])}}
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label" for="title_en">{{trans('common.title_en')}}</label>
                                            {{Form::text('title_en',$len->title_en,['id'=>'title_en', 'class'=>'form-control'])}}
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label" for="unit_length_ar">{{trans('common.unit_length_ar')}}</label>
                                            {{Form::text('unit_length_ar',$len->unit_length_ar,['id'=>'unit_length_ar', 'class'=>'form-control','required'])}}
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label" for="unit_length_en">{{trans('common.unit_length_en')}}</label>
                                            {{Form::text('unit_length_en',$len->unit_length_en,['id'=>'unit_length_en', 'class'=>'form-control','required'])}}
                                        </div>

                                        <div class="col-12 col-md-6">
                                            <label class="form-label" for="value">{{trans('common.Value')}}</label>
                                            {{Form::number('value',$len->value,['id'=>'value', 'step'=>'.0001', 'class'=>'form-control','required'])}}
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <label class="form-label" for="primary">{{trans('common.default')}}</label>
                                            <div class="form-check form-check-success form-switch">
                                                {{Form::checkbox('primary','1',$len->primary == '0' ? false : true,['id'=>'primary', 'class'=>'form-check-input'])}}
                                                <label class="form-check-label" for="primary"></label>
                                            </div>
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


                {{ $length->links('vendor.pagination.default') }}


            </div>
        </div>
    </div>
    <!-- Bordered table end -->



@stop

@section('page_buttons')
    <a href="javascript:;" data-bs-target="#createlen" data-bs-toggle="modal" class="btn btn-primary">
        {{trans('common.CreateNew')}}
    </a>
    <div class="modal fade text-md-start" id="createlen" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">{{trans('common.CreateNew')}}</h1>
                    </div>
                    {{Form::open(['url'=>route('admin.length.store'), 'id'=>'createlenForm', 'class'=>'row gy-1 pt-75'])}}
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="title_ar">{{trans('common.title_ar')}}</label>
                            {{Form::text('title_ar','',['id'=>'title_ar', 'class'=>'form-control','required'])}}
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="title_en">{{trans('common.title_en')}}</label>
                            {{Form::text('title_en','',['id'=>'title_en', 'class'=>'form-control'])}}
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="unit_length_ar">{{trans('common.unit_length_ar')}}</label>
                            {{Form::text('unit_length_ar','',['id'=>'unit_length_ar', 'class'=>'form-control','required'])}}
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="unit_length_en">{{trans('common.unit_length_en')}}</label>
                            {{Form::text('unit_length_en','',['id'=>'unit_length_en', 'class'=>'form-control','required'])}}
                        </div>

                        <div class="col-12 col-md-6">
                            <label class="form-label" for="value">{{trans('common.Value')}}</label>
                            {{Form::number('value','',['id'=>'value', 'step'=>'.0001', 'class'=>'form-control','required'])}}
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="primary">{{trans('common.default')}}</label>
                            <div class="form-check form-check-success form-switch">
                                {{Form::checkbox('primary','1',false,['id'=>'primary', 'class'=>'form-check-input'])}}
                                <label class="form-check-label" for="primary"></label>
                            </div>
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
