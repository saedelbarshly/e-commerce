@extends('AdminPanel.layouts.master')
@section('content')


    <!-- Bordered table start -->
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{$title}}</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-2">
                        <thead>
                            <tr>
                                <th class="text-center">{{trans('common.from')}}</th>
                                <th class="text-center">{{trans('common.to')}}</th>
                                <th class="text-center">{{trans('common.price')}}</th>
                                <th class="text-center">{{trans('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($ShippingLocales as $local)
                            <tr id="row_{{$local->id}}">
                                <td>
                                    {{$local->fromCountry->apiData(session()->get('Lang'))['name'] ?? ''}}<br>
                                    {{$local['from_city']}}
                                </td>
                                <td>
                                    {{$local->toCountry->apiData(session()->get('Lang'))['name'] ?? ''}}<br>
                                    {{$local['to_city']}}
                                </td>
                                <td>
                                    {{$local['price']}}
                                </td>
                                <td class="text-center">
                                    <a href="javascript:;" data-bs-target="#editsection{{$local->id}}" data-bs-toggle="modal" class="btn btn-icon btn-info">
                                        <i data-feather='edit' data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.edit')}}"></i>
                                    </a>
                                    <?php $delete = route('admin.shippingLocales.delete',['id'=>$local->id]); ?>
                                    <button type="button" class="btn btn-icon btn-danger" onclick="confirmDelete('{{$delete}}','{{$local->id}}')" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.delete')}}">
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

                @foreach($ShippingLocales as $local)
                    <div class="modal fade text-md-start" id="editsection{{$local->id}}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body pb-5 px-sm-5 pt-50">
                                    <div class="text-center mb-2">
                                        <h1 class="mb-1">{{trans('common.edit')}}</h1>
                                    </div>
                                    {{Form::open(['url'=>route('admin.shippingLocales.update',['id'=>$local->id]), 'id'=>'editsectionForm', 'class'=>'row gy-1 pt-75'])}}
                                        <div class="col-12 col-md-3">
                                            <label class="form-label" for="from_country">{{trans('common.from_country')}}</label>
                                            {{Form::select('from_country',[''=>trans('common.country')] + getCountriesList(session()->get('Lang'),'id'),$local->from_country,['id'=>'from_country', 'class'=>'form-control selectpicker','data-live-search'=>'true'])}}
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label" for="from_city">{{trans('common.city')}}</label>
                                            {{Form::text('from_city',$local->from_city,['id'=>'from_city', 'class'=>'form-control'])}}
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label" for="to_country">{{trans('common.to_country')}}</label>
                                            {{Form::select('to_country',[''=>trans('common.country')] + getCountriesList(session()->get('Lang'),'id'),$local->to_country,['id'=>'to_country', 'class'=>'form-control selectpicker','data-live-search'=>'true'])}}
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label" for="to_city">{{trans('common.city')}}</label>
                                            {{Form::text('to_city',$local->to_city,['id'=>'to_city', 'class'=>'form-control'])}}
                                        </div>
                                        <div class="col-12 col-md-3">
                                            <label class="form-label" for="price">{{trans('common.price')}}</label>
                                            {{Form::text('price',$local->price,['id'=>'price', 'class'=>'form-control'])}}
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


                {{ $ShippingLocales->links('vendor.pagination.default') }}


            </div>
        </div>
    </div>
    <!-- Bordered table end -->



@stop

@section('page_buttons')
    <a href="javascript:;" data-bs-target="#createsection" data-bs-toggle="modal" class="btn btn-primary">
        {{trans('common.CreateNew')}}
    </a>

    <div class="modal fade text-md-start" id="createsection" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">{{trans('common.CreateNew')}}</h1>
                    </div>
                    {{Form::open(['url'=>route('admin.shippingLocales.store'), 'id'=>'createsectionForm', 'class'=>'row gy-1 pt-75'])}}
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="from_country">{{trans('common.from_country')}}</label>
                            {{Form::select('from_country',[''=>trans('common.country')] + getCountriesList(session()->get('Lang'),'id'),'',['id'=>'from_country', 'class'=>'form-control selectpicker','data-live-search'=>'true'])}}
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="from_city">{{trans('common.city')}}</label>
                            {{Form::text('from_city','',['id'=>'from_city', 'class'=>'form-control'])}}
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="to_country">{{trans('common.to_country')}}</label>
                            {{Form::select('to_country',[''=>trans('common.country')] + getCountriesList(session()->get('Lang'),'id'),'',['id'=>'to_country', 'class'=>'form-control selectpicker','data-live-search'=>'true'])}}
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="to_city">{{trans('common.city')}}</label>
                            {{Form::text('to_city','',['id'=>'to_city', 'class'=>'form-control'])}}
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="price">{{trans('common.price')}}</label>
                            {{Form::text('price','',['id'=>'price', 'class'=>'form-control'])}}
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