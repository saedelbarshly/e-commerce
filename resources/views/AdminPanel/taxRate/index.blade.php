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
                                <th>{{trans('common.name')}}</th>
                                <th class="text-center">{{trans('common.price')}}</th>
                                <th class="text-center">{{trans('common.type')}}</th>
                                <th class="text-center">{{trans('common.geographicalArea')}}</th>
                                <th class="text-center">{{trans('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse($taxRates as $taxRate)
                            <tr id="row_{{$taxRate->id}}">
                                <td>
                                    {{$taxRate['name_ar']}}<br>
                                    {{$taxRate['name_en']}}
                                </td>
                                <td class="text-center">
                                    {{$taxRate->price}}
                                </td>
                                <td class="text-center">
                                        {{($taxRate->type == 'percent') ? 'نسبة مئوية' : 'سعر ثابت' }}
                                </td>
                                <td class="text-center">
                                        {{$taxRate->geographicalArea}}
                                </td>
                                <td class="text-center">
                                    <a href="javascript:;" data-bs-target="#edittaxRate{{$taxRate->id}}" data-bs-toggle="modal" class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.edit')}}">
                                        <i data-feather='edit'></i>
                                    </a>
                                    <?php $delete = route('admin.taxRates.delete',['taxRate'=>$taxRate->id]); ?>
                                    <button type="button" class="btn btn-icon btn-danger" onclick="confirmDelete('{{$delete}}','{{$taxRate->id}}')" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.delete')}}">
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

                @foreach($taxRates as $taxRate)
                    <div class="modal fade text-md-start" id="edittaxRate{{$taxRate->id}}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body pb-5 px-sm-5 pt-50">
                                    <div class="text-center mb-2">
                                        <h1 class="mb-1">{{trans('common.edit')}}</h1>
                                    </div>
                                    {{Form::open(['url'=>route('admin.taxRates.update',['taxRate'=>$taxRate->id]), 'id'=>'edittaxRateForm', 'class'=>'row gy-1 pt-75'])}}
                                        <div class="col-12 col-md-6">
                                          <label class="form-label" for="name_ar">{{trans('common.name_ar')}}</label>
                                          {{Form::text('name_ar',$taxRate->name_ar,['id'=>'name_ar', 'class'=>'form-control','required'])}}
                                        </div>
                                        <div class="col-12 col-md-6">
                                          <label class="form-label" for="name_en">{{trans('common.name_en')}}</label>
                                          {{Form::text('name_en',$taxRate->name_en,['id'=>'name_en', 'class'=>'form-control'])}}
                                        </div>
                                        <div class="col-12 col-md-6">
                                          <label class="form-label" for="price">{{trans('common.price')}}</label>
                                          {{Form::number('price',$taxRate->price,['id'=>'price', 'class'=>'form-control','required', 'min'=>'0'])}}
                                        </div>
                                        <div class="col-12 col-md-6">
                                          <label class="repeater-title" for="type">{{trans('common.type')}}</label>
                                          <select class="form-select item-details" id="type" name="type">
                                            <option disabled> اختار النوع</option>
                                            <option value="percent" {{ ($taxRate->type == 'percent') ? 'selected' : ''}}>نسبة مئوية</option>
                                            <option value="fixed" {{ ($taxRate->type == 'fixed') ? 'selected' : ''}}>سعر ثابت</option>
                                          </select>
                                        </div>
                                        <div class="col-12 col-md-12">
                                          <label class="form-label" for="geographicalArea">{{trans('common.geographicalArea')}}</label>
                                          {{Form::text('geographicalArea',$taxRate->geographicalArea,['id'=>'geographicalArea', 'class'=>'form-control'])}}
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


                {{ $taxRates->links('vendor.pagination.default') }}


            </div>
        </div>
    </div>
    <!-- Bordered table end -->



@stop

@section('page_buttons')
    <a href="javascript:;" data-bs-target="#createtaxRate" data-bs-toggle="modal" class="btn btn-primary">
        {{trans('common.CreateNew')}}
    </a>
    <div class="modal fade text-md-start" id="createtaxRate" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">{{trans('common.CreateNew')}}</h1>
                    </div>
                    {{Form::open(['url'=>route('admin.taxRates.store'), 'id'=>'createtaxRateForm', 'class'=>'row gy-1 pt-75'])}}
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="name_ar">{{trans('common.name_ar')}}</label>
                            {{Form::text('name_ar','',['id'=>'name_ar', 'class'=>'form-control','required'])}}
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="name_en">{{trans('common.name_en')}}</label>
                            {{Form::text('name_en','',['id'=>'name_en', 'class'=>'form-control'])}}
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="price">{{trans('common.price')}}</label>
                            {{Form::number('price','',['id'=>'price', 'class'=>'form-control','required', 'min'=>'0'])}}
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="repeater-title" for="type">{{trans('common.type')}}</label>
                          <select class="form-select item-details" id="type" name="type">
                              <option disabled selected> اختار النوع</option>
                              <option value="percent">نسبة مئوية</option>
                              <option value="fixed">سعر ثابت</option>
                          </select>
                        </div>
                        <div class="col-12 col-md-12">
                          <label class="form-label" for="geographicalArea">{{trans('common.geographicalArea')}}</label>
                          {{Form::text('geographicalArea','',['id'=>'geographicalArea', 'class'=>'form-control'])}}
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
