<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="description" content="multikart">
  <meta name="keywords" content="multikart">
  <meta name="author" content="multikart">
  <link rel="icon" href="{{ getSettingImageLink('logo') }}" type="image/x-icon">
  <link rel="shortcut icon" href="{{ getSettingImageLink('logo') }}" type="image/x-icon">
  <title>{{ $title }}</title>

  <!--Google font-->
  <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
    rel="stylesheet">

  <!-- Icons -->
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/vendors/font-awesome.css')}}">

  <!-- Animate icon -->
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/vendors/animate.css')}}">

  <!-- Themify icon -->
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/vendors/themify-icons.css')}}">

  <!-- Bootstrap css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/vendors/bootstrap.css')}}">

  <!-- Theme css -->
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/style.css')}}">
  @if(app()->getLocale() == 'ar')
  <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/style-ar.css') }}">
  @endif

</head>

<body class="theme-color-1 bg-light {{ (app()->getLocale() == 'ar') ? 'rtl' : '' }}">


  <!-- invoice start -->
  <section class="theme-invoice-4 section-b-space">
    <div class="container">
      <div class="row">
        <div class="col-xl-9 m-auto">
          <div class="invoice-wrapper">
            <div class="invoice-header">
              <img src="{{ asset('uploads/settings/'.getSettingValue('logo') ) }}" class="img-fluid" alt="logo">
            </div>
            <div class="invoice-body">
              <div class="top-sec">
                <div class="row">
                  <div class="col-xxl-8 col-md-7">
                   <div class="card-body invoice-padding pt-0">
                      <div class="row invoice-spacing">
                        <div class="col-xl-8 p-0">
                          <h6 class="mb-2">{{trans('common.client')}}:</h6>
                          <h6 class="mb-25">{{$order->client->name ?? '-'}}</h6>
                          <p class="card-text mb-25">
                            {{ $order->address != '' ? $order->address->address : '' }}
                            <br>
                            {{ $order->address != '' ? $order->address->city : '' }}
                          </p>

                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-xxl-4 col-md-5">
                    <ul class="date-detail">
                      <li><span>{{ trans('common.date') }} :</span>
                        <h4> {{ $order->created_at->format('Y M d') }}</h4>
                      </li>
                      <li><span># :</span>
                        <h4> {{ $order->id  }}</h4>
                      </li>
                      <li><span>{{ trans('common.email') }} :</span>
                        <h4> {{ $order->address != '' ? $order->address->email : '' }}</h4>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="title-sec">
                <h2 class="title">{{ trans('common.invoice') }}</h2>
                <div class="row">
                  <div class="col-6">
                    <a href="#" class="btn black-btn btn-solid" onclick="window.print();">
                      {{ trans('common.exportAsPDF') }}</a>
                  </div>
                  <div class="col-6 text-end">
                    <a href="#" class="btn btn-solid" onclick="window.print();">
                      {{ trans('common.print') }}
                    </a>
                  </div>
                </div>
              </div>
              <div class="table-sec">
                <div class="table-responsive-md">
                  <table class="table table-borderless table-striped mb-0">
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
                      </tr>
                    </thead>
                   <tbody>
                    @forelse($order->items as $item)
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
                        <span class="fw-bold">{{$item->price * $item->quantity}}</span>
                      </td>
                    </tr>
                    @empty

                    @endforelse
                    <tr>
                      <th class="py-1" colspan="8">{{trans('common.discount')}}</th>
                      <td class="py-1">
                        <span class="fw-bold">{{$order->discount}}</span>
                      </td>
                    </tr>
                  </tbody>
                  </table>
                </div>
                <div class="text-end">
                  <div class="table-footer">
                    <span class="me-5 font-bold">{{ trans('common.GrandTotal') }}</span>
                    <span class="font-bold">{{ $order->net_total }}</span>
                  </div>
                </div>
              </div>
            </div>
            <div class="invoice-footer">
              <img src="{{ asset('frontend/assets/images/invoice/shape.png')}} class="img-fluid design-shape" alt="">
              <ul>
                <li>
                  <i class="fa fa-map" aria-hidden="true"></i>
                  <div>
                    <h4>{{ getSettingValue('siteTitle_'.app()->getLocale()) }}</h4>
                    <h4>{{ getSettingValue('address') }}</h4>
                  </div>
                </li>
                <li>
                  <i class="fa fa-phone" aria-hidden="true"></i>
                  <div>
                    <h4>{{ getSettingValue('phone') }}</h4>

                  </div>
                </li>
                <li>
                  <i class="fa fa-envelope" aria-hidden="true"></i>
                  <div>
                    <h4>{{ getSettingValue('email') }}</h4>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- invoice end -->


  <!-- latest jquery-->
  <script src="{{ asset('frontend/assets/js/jquery-3.3.1.min.js')}}"></script>

  <!-- Bootstrap js-->
  <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js')}}"></script>

</body>

</html>
