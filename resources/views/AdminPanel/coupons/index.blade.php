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
                                <th scope="col" class="text-nowrap text-center" style="width:30px;">#</th>
                                <th scope="col" class="text-nowrap">كود القسيمة</th>
                                <th scope="col" class="text-nowrap text-center">قيمة القسيمة</th>
                                <th scope="col" class="text-nowrap text-center">تاريخ نهايتها</th>
                                <th scope="col" class="text-nowrap text-center">عدد العملاء الأقصى</th>
                                <th scope="col" class="text-nowrap text-center">الحالة</th>
                                <th scope="col" class="text-nowrap text-center">أدوات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $x = 1;
                            @endphp
                            @foreach ($coupons as $coupon)
                            <tr id="row_{{$coupon->id}}">
                                <td class="text-nowrap text-center">{{ $x++ }}</td>
                                <td class="text-nowrap">
                                    <small>{{$coupon->coupon}}</small>
                                </td>
                                <td class="text-nowrap text-center">
                                    <small>{{$coupon->value()}}</small>
                                </td>
                                <td class="text-nowrap text-center">
                                    <small>{{DayMonthOnly($coupon->max_date)}}</small>
                                </td>
                                <td class="text-nowrap text-center">
                                    <small>
                                        {{$coupon->max_invoices()}}
                                    </small>
                                </td>
                                <td class="text-nowrap text-center">
                                    <small>
                                        {!!$coupon->arabicStatus()['message']!!}
                                    </small>
                                </td>
                                <td class="text-nowrap text-center">
                                    <?php $delete = route('admin.coupons.destroy', $coupon->id); ?>
                                    <button type="button" class="btn btn-icon btn-danger" onclick="confirmDelete('{{$delete}}','{{$coupon->id}}')" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.delete')}}">
                                        <i data-feather='trash-2'></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $coupons->links('vendor.pagination.default') }}

                </div>
        </div>
    </div>
    <!-- Bordered table end -->


@stop

@section('page_buttons')
    <a href="javascript:;" data-bs-target="#createCoupon" data-bs-toggle="modal" class="btn btn-primary">
        {{trans('common.CreateNew')}}
    </a>

    <div class="modal fade text-md-start" id="createCoupon" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">{{trans('common.CreateNew')}}</h1>
                    </div>
                    {{Form::open(['url'=>route('admin.coupons.store'),'class'=>'form-validate'])}}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-1">
                                    <label class="form-label" for="coupon">كود القسيمة الشرائية</label>
                                    {{Form::text('coupon','',['class'=>'form-control','required'])}}
                                    @error('coupon')
                                        <strong class="alert alert-danger" role="alert">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-1">
                                    <label class="form-label" for="percentage">الخصم (بالنسبة)</label>
                                    {{Form::number('percentage','',['class'=>'form-control'])}}
                                    @error('percentage')
                                        <strong class="alert alert-danger" role="alert">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-1">
                                    <label class="form-label" for="amount">الخصم (رقم ثابت)</label>
                                    {{Form::number('amount','',['class'=>'form-control'])}}
                                    @error('amount')
                                        <strong class="alert alert-danger" role="alert">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-1">
                                    <label class="form-label" for="max_date">تاريخ انتهاء القسيمة</label>
                                    {{Form::date('max_date','',['class'=>'form-control','required'])}}
                                    @error('max_date')
                                        <strong class="alert alert-danger" role="alert">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-1">
                                    <label class="form-label" for="max_clients">أقصى عدد من العملاء (صفر يعني غير محدود)</label>
                                    {{Form::number('max_clients','0',['class'=>'form-control'])}}
                                    @error('max_clients')
                                        <strong class="alert alert-danger" role="alert">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-2 mt-2">
                                <button type="submit" class="btn btn-primary mb-1 mb-sm-0 me-0 me-sm-1">حفظ</button>
                            </div>
                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@stop
