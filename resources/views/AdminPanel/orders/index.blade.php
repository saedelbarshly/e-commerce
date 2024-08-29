@extends('AdminPanel.layouts.master')
@section('content')


    <!-- Bordered table start -->

    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $title }}</h4>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-2">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>{{ trans('common.date') }}</th>
                                <th>{{ trans('common.client') }}</th>
                                <th>{{ trans('common.total') }}</th>
                                <th>{{ trans('common.products') }}</th>
                                <th class="text-center">{{ trans('common.actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr id="row_{{$order->id}}">
                                    <td>{{$order->id}}</td>
                                    <td>
                                        {{$order->date_time}}
                                    </td>
                                    <td>
                                        {{$order->client->name ?? '-'}}
                                    </td>
                                    <td>
                                      {{trans('common.total')}}: {{$order->totals()['subtotal']}}<br>
                                      {{ trans('common.shippingPrice') }}: {{ $order->totals()['shippingPrice'] }}
                                      <br>{{trans('common.discount')}}: {{$order->totals()['discount']}}
                                      <br>{{trans('common.netTotal')}}: {{$order->totals()['netTotal']}}
                                    </td>
                                    <td>
                                      @foreach($order->items as $item)
                                        @if($item->product != '')
                                        {{ trans('common.product_name_ar') }}:
                                        <span class="badge badge-light-dark"> {{ $item->product->name_ar}} </span> <br/>
                                        {{ trans('common.product_name_en') }}:
                                        <span class="badge badge-light-dark"> {{ $item->product->name_en}} </span> <br/>
                                          {{ trans('common.quantity') }}:
                                            <span class="badge badge-light-success"> {{ $item->quantity }} </span> <br/>
                                            {{ trans('common.price') }}:
                                            <span class="badge badge-light-danger"> {{ $item->price }}</span> <br />
                                          @endif
                                      @endforeach
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.orders.details', ['id' => $order->id]) }}"
                                            class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top"
                                            data-bs-original-title="{{ trans('common.from_details') }}">
                                            <i data-feather='list'></i>
                                        </a>
                                        <?php /*$delete = route('admin.orders.delete', ['id' => $order->id]); ?>
                                        <button type="button" class="btn btn-icon btn-danger"
                                            onclick="confirmDelete('{{ $delete }}','{{ $order->id }}')">
                                            <i data-feather='trash-2'></i>
                                        </button>
                                        */ ?>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="22" class="p-3 text-center ">
                                        <h2>{{ trans('common.nothingToView') }}</h2>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- {{$orders->links('vendor.pagination.default') }} --}}


            </div>
        </div>
    </div>
    <!-- Bordered table end -->



@stop

@section('page_buttons')
    <a href="javascript:;" data-bs-target="#searchOrders" data-bs-toggle="modal" class="btn btn-primary">
        {{trans('common.search')}}
    </a>

    <div class="modal fade text-md-start" id="searchOrders" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">{{trans('common.search')}}</h1>
                    </div>
                    {{Form::open(['url'=>route('admin.orders'), 'id'=>'searchOrdersForm', 'class'=>'row gy-1 pt-75','method'=>'GET'])}}
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="client_id">{{trans('common.client')}}</label>
                            {{Form::select('client_id',
                                                    [''=>trans('common.allClients')]
                                                    + App\Models\User::where('role','3')->pluck('name','id')->all(),
                                                    isset($_GET['client_id']) ? $_GET['client_id'] : '',['id'=>'client_id', 'class'=>'form-control selectpicker','data-live-search'=>'true'])}}
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="order_id">{{trans('common.order_id')}}</label>
                            {{Form::text('order_id',isset($_GET['order_id']) ? $_GET['order_id'] : '',['id'=>'order_id', 'class'=>'form-control'])}}
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="from_date">{{trans('common.from_date')}}</label>
                            {{Form::date('from_date',isset($_GET['from_date']) ? $_GET['from_date'] : '',['id'=>'from_date', 'class'=>'form-control'])}}
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label" for="to_date">{{trans('common.to_date')}}</label>
                            {{Form::date('to_date',isset($_GET['to_date']) ? $_GET['to_date'] : '',['id'=>'to_date', 'class'=>'form-control'])}}
                        </div>
                        <div class="col-12 text-center mt-2 pt-50">
                            <button type="submit" class="btn btn-primary me-1">{{trans('common.search')}}</button>
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
