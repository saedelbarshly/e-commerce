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
                                <th class="text-center">{{trans('common.specificationType')}}</th>
                                <th class="text-center">{{trans('common.ordering')}}</th>
                                <th class="text-center">{{trans('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse($specifications as $specification)
                            <tr id="row_{{$specification->id}}">
                                <td>
                                    {{$specification['name_ar']}}<br>
                                    {{$specification['name_en']}}
                                </td>
                                <td>
                                    {{$specification->specificationTypes->name_ar}}<br>
                                    {{$specification->specificationTypes->name_en}}
                                </td>
                                <td class="text-center">
                                    {{$specification->ordering}}
                                </td>
                                <td class="text-center">
                                    <a href="javascript:;" data-bs-target="#editspecification{{$specification->id}}" data-bs-toggle="modal" class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.edit')}}">
                                        <i data-feather='edit'></i>
                                    </a>
                                    <?php $delete = route('admin.specifications.delete',['specification'=>$specification->id]); ?>
                                    <button specification="button" class="btn btn-icon btn-danger" onclick="confirmDelete('{{$delete}}','{{$specification->id}}')" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.delete')}}">
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

                @foreach($specifications as $specification)
                    <div class="modal fade text-md-start" id="editspecification{{$specification->id}}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <button specification="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body pb-5 px-sm-5 pt-50">
                                    <div class="text-center mb-2">
                                        <h1 class="mb-1">{{trans('common.edit')}}</h1>
                                    </div>
                                    {{Form::open(['url'=>route('admin.specifications.update',['specification'=>$specification->id]), 'id'=>'editspecificationForm', 'class'=>'row gy-1 pt-75','files'=>true])}}
                                      <div class="col-12 col-md-6">
                                        <label class="form-label" for="name_ar">{{trans('common.name_ar')}}</label>
                                        {{Form::text('name_ar',$specification->name_ar,['id'=>'name_ar', 'class'=>'form-control','required'])}}
                                      </div>
                                      <div class="col-12 col-md-6">
                                        <label class="form-label" for="name_en">{{trans('common.name_en')}}</label>
                                        {{Form::text('name_en',$specification->name_en,['id'=>'name_en', 'class'=>'form-control'])}}
                                      </div>
                                      <div class="col-12 col-md-12">
                                          <label class="repeater-title" for="specification_type_id">{{trans('common.specificationType')}}</label>
                                          <select class="form-select item-details" id="specification_type_id" name="specification_type_id">
                                            <option disabled>--إختيار النوع--</option>
                                            @foreach($specificationTypes as $Type)
                                            <option value="{{$Type->id}}" {{ ($Type->id == $specification->specification_type_id) ? 'selected' : ''}}>
                                              {{ $Type->name_ar}}
                                            </option>
                                            @endforeach
                                          </select>
                                        </div>
                                      <div class="col-12 col-md-12">
                                        <label class="form-label" for="ordering">{{trans('common.ordering')}}</label>
                                        {{Form::number('ordering',$specification->ordering,['id'=>'ordering', 'step'=>'1', 'class'=>'form-control','required', 'min'=>0])}}
                                      </div>
                                        <div class="col-12 text-center mt-2 pt-50">
                                            <button specification="submit" class="btn btn-primary me-1">{{trans('common.Save changes')}}</button>
                                            <button specification="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                                {{trans('common.Cancel')}}
                                            </button>
                                        </div>
                                    {{Form::close()}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{ $specifications->links('vendor.pagination.default') }}

            </div>
        </div>
    </div>
    <!-- Bordered table end -->

@stop

@section('page_buttons')
    <a href="javascript:;" data-bs-target="#createspecification" data-bs-toggle="modal" class="btn btn-primary">
        {{trans('common.CreateNew')}}
    </a>
    <div class="modal fade text-md-start" id="createspecification" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button specification="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">{{trans('common.CreateNew')}}</h1>
                    </div>
                    {{Form::open(['url'=>route('admin.specifications.store'), 'id'=>'createspecificationForm', 'class'=>'row gy-1 pt-75', 'files'=>'true'])}}
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="name_ar">{{trans('common.name_ar')}}</label>
                            {{Form::text('name_ar','',['id'=>'name_ar', 'class'=>'form-control','required'])}}
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="name_en">{{trans('common.name_en')}}</label>
                            {{Form::text('name_en','',['id'=>'name_en', 'class'=>'form-control'])}}
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="repeater-title" for="specification_type_id">{{trans('common.specificationType')}}</label>
                            <select class="form-select item-details" id="specification_type_id" name="specification_type_id">
                              <option selected disabled>--إختيار النوع--</option>
                              @foreach($specificationTypes as $Type)
                              <option value="{{$Type->id}}"> {{$Type->name_ar}}</option>
                              @endforeach
                            </select>
                          </div>
                        <div class="col-12 col-md-12">
                          <label class="form-label" for="ordering">{{trans('common.ordering')}}</label>
                          {{Form::number('ordering','',['id'=>'ordering', 'step'=>'1', 'class'=>'form-control','required', 'min'=>0])}}
                        </div>
                        <div class="col-12 text-center mt-2 pt-50">
                            <button specification="submit" class="btn btn-primary me-1">{{trans('common.Save changes')}}</button>
                            <button specification="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                {{trans('common.Cancel')}}
                            </button>
                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@stop
