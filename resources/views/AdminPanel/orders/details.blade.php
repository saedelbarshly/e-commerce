@extends('AdminPanel.layouts.master')

@section('content')
    <section class="invoice-preview-wrapper">
        <div class="row invoice-preview">
            <!-- Invoice -->
            <div class="col-xl-12 col-md-12 col-12">
                <div class="card invoice-preview-card">
                    <div class="card-body invoice-padding pb-0">
                        <!-- Header starts -->
                        <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0 mb-0">
                            <div>
                                <div class="logo-wrapper mb-0">
                                    @if(getSettingImageLink('logo') != '')
                                        <img src="{{getSettingImageLink('logo')}}" height="80" />
                                    @endif
                                    <h3 class="text-primary invoice-logo">{{getSettingValue('siteTitle_'.session()->get('Lang'))}}</h3>
                                </div>
                            </div>
                            <div class="mt-md-0 mb-0 pt-2">
                                <h4 class="invoice-title mb-0">
                                    {{trans('common.order')}}
                                    <span class="invoice-number">#{{$order->id}}</span>
                                    <p class="invoice-date">{{date('d/m/Y',$order->date_time_str)}}</p>
                                </h4>
                            </div>
                        </div>
                        <!-- Header ends -->
                    </div>
                    <hr class="invoice-spacing" />
                    <!-- Address and Contact starts -->
                    <div class="card-body invoice-padding pt-0">
                        <div class="row invoice-spacing">
                            <div class="col-xl-8 p-0">
                                <h6 class="mb-2">{{trans('common.client')}}:</h6>
                                <h6 class="mb-25">{{$order->client->name ?? '-'}}</h6>
                                @if ($order->address != '')

                                <p class="card-text mb-25">

                                      {{ trans('common.postalCode') . ' : ' . $order->address->postalCode ??  '-'}} <br />
                                      {{ trans('common.email') . ' : ' . $order->address->email ??  '-'}} <br />
                                      {{ trans('common.phone') . ' : ' . $order->address->phone ??  '-'}} <br />
                                      {{ trans('common.city') . ' : ' . $order->address->city ??  '-'}} <br />
                                      {{ trans('common.address') . ' : ' . $order->address->address ??  '-'}} <br />

                                </p>
                                @endif

                            </div>
                        </div>
                    </div>
                    <!-- Address and Contact ends -->

                    <!-- Invoice Description starts -->
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="py-1">{{trans('common.products')}}</th>
                                    <th class="py-1">{{trans('common.type')}}</th>
                                    <th class="py-1">{{trans('common.length')}}</th>
                                    <th class="py-1">{{trans('common.width')}}</th>
                                    <th class="py-1">{{trans('common.weight')}}</th>
                                    <th class="py-1">{{trans('common.height')}}</th>
                                    <th class="py-1">{{trans('common.price')}}</th>
                                    <th class="py-1">{{trans('common.quantity')}}</th>
                                    <th class="py-1">{{trans('common.total')}}</th>
                                    <th class="py-1">{{trans('common.shippingPrice')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($order->items as $item)
                                    @if($item->product != '')
                                    <tr>
                                        <td class="py-1">
                                            <p class="card-text fw-bold mb-25">{{$item->product['name_'.session()->get('Lang')] ?? '-'}}</p>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">{{$item->product->type}}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">{{$item->product->length}}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">{{$item->product->width}}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">{{$item->product->weight}}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">{{$item->product->height}}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">{{$item->price}}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">{{$item->quantity}}</span>
                                        </td>
                                        <td class="py-1">
                                            <span class="fw-bold">{{$item->totals()}}</span>
                                        </td>
                                        <td class="py-1">
                                          <span class="fw-bold">{{$item->shipping_price}}</span>
                                        </td>
                                    </tr>
                                    @endif
                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="card-body invoice-padding pb-0">
                        <div class="row invoice-sales-total-wrapper">
                            <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                            </div>
                            <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                                <div class="invoice-total-wrapper">
                                    <div class="invoice-total-item">
                                        <p class="invoice-total-title">{{trans('common.subtotal')}}:</p>
                                        <p class="invoice-total-amount">{{$order->totals()['subtotal']}}</p>
                                    </div>
                                    <div class="invoice-total-item">
                                        <p class="invoice-total-title">{{trans('common.discount')}}:</p>
                                        <p class="invoice-total-amount">{{$order->totals()['discount']}}</p>
                                    </div>
                                    <div class="invoice-total-item">
                                        <p class="invoice-total-title">{{trans('common.shippingPrice')}}:</p>
                                        <p class="invoice-total-amount">{{$order->totals()['shippingPrice']}}</p>
                                    </div>
                                    <div class="invoice-total-item">
                                        <p class="invoice-total-title">{{trans('common.taxRate')}}:</p>
                                        <p class="invoice-total-amount">{{$order->totals()['taxRate']}}</p>
                                    </div>
                                    <hr class="my-50" />
                                    <div class="invoice-total-item">
                                        <p class="invoice-total-title">{{trans('common.netTotal')}}:</p>
                                        <p class="invoice-total-amount">{{$order->totals()['netTotal']}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Invoice Description ends -->
                </div>
            </div>
            <!-- /Invoice -->
        </div>
    </section>
@stop

@section('new_style')
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('AdminAssets/app-assets/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminAssets/app-assets/css-rtl/plugins/forms/pickers/form-flat-pickr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminAssets/app-assets/css-rtl/pages/app-invoice.css')}}">
    <!-- END: Page CSS-->
@stop
@section('scripts')
    <!-- BEGIN: Page JS-->
    <script src="{{asset('AdminAssets/app-assets/js/scripts/pages/app-invoice.js')}}"></script>
    <!-- END: Page JS-->
@stop
