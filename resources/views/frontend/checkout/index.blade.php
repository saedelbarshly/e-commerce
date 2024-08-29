@extends('frontend.layouts.master')
@section('content')
<!-- breadcrumb start -->
@include('frontend.layouts.topbar.breadcrumbs')
<!-- breadcrumb End -->
<!-- section start -->
<section class="section-b-space">
  <div class="container">
    <div class="checkout-page">
      <div class="checkout-form">
        <form method="post" action="{{ route('checkout.store') }}">
          @csrf
          <div class="row">
              <div class="col-lg-6 col-sm-12 col-xs-12">
                <div class="checkout-title">
                    <h3>{{ trans('common.BillingDetails') }}</h3>
                </div>
                <div class="row check-out">
                  <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    <label class="field-label" for="first_name">{{ trans('common.firstName') }}</label>
                    <span class="validity text-danger">*</span>
                    {!! Form::text('first_name',$order->address != '' ? $order->address->first_name : '',['id'=>'first_name','required']) !!}
                    @error('first_name')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    <label class="field-label" for="last_name">{{ trans('common.lastName') }}</label>
                    <span class="validity text-danger">*</span>
                    {!! Form::text('last_name',$order->address != '' ? $order->address->last_name : '',['id'=>'last_name','required']) !!}
                    @error('last_name')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    <label class="field-label" for="phone">{{ trans('common.phone') }}</label>
                    <span class="validity text-danger">*</span>
                    {!! Form::text('phone',$order->address != '' ? $order->address->phone : '',['id'=>'phone','required']) !!}
                    @error('phone')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group col-md-6 col-sm-6 col-xs-12">
                    <label class="field-label" for="email">{{ trans('common.email') }}</label>
                    <span class="validity text-danger">*</span>
                    {!! Form::email('email',$order->address != '' ? $order->address->email : '',['id'=>'email','required']) !!}
                    @error('email')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <label class="field-label" for="country">{{ trans('common.country') }}</label>
                    <span class="validity text-danger">*</span>
                    {!! Form::select('country',$countries,$order->address != '' ? $order->address->country : '',['id'=>'country','placeholder'=>trans('common.selectYourCountry'),'required']) !!}
                    @error('country')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <label class="field-label" for="city">{{ trans('common.city') }}</label>
                    <span class="validity text-danger">*</span>
                    {!! Form::text('city',$order->address != '' ? $order->address->city : '',['id'=>'city','required']) !!}
                    @error('city')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <label class="field-label" for="address">{{ trans('common.address') }}</label>
                    <span class="validity text-danger">*</span>
                    {!! Form::text('address',$order->address != '' ? $order->address->address : '',['id'=>'address','required']) !!}
                    @error('address')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <label class="field-label" for="postalCode">{{ trans('common.postalCode') }}</label>
                    <span class="validity text-danger">*</span>
                    {!! Form::text('postalCode',$order->address != '' ? $order->address->postalCode : '',['id'=>'postalCode','required']) !!}
                    @error('postalCode')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div>
                  {{-- <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <label class="field-label" for="chooseDeliveryMethod">{{ trans('common.chooseDeliveryMethod') }}</label>
                    <span class="validity text-danger">*</span>
                    {!! Form::select('chooseDeliveryMethod',[
                                                              '0' => trans('common.delivertobranch'),
                                                              '1' => trans('common.delivertohome').' '.(getSettingValue('deliveryPrice') > 0 ? ' - '.getSettingValue('deliveryPrice') : ''),
                                                            ],$order->address != '' ? $order->address->chooseDeliveryMethod : '',['id'=>'chooseDeliveryMethod','required']) !!}
                    @error('chooseDeliveryMethod')
                      <span class="text-danger">{{ $message }}</span>
                    @enderror
                  </div> --}}
                </div>
                </div>
              <div class="col-lg-6 col-sm-12 col-xs-12">
                <div class="checkout-details">
                  <div class="order-box">
                    <div class="title-box">
                      <div>
                        {{ trans('common.products') }}
                        <span>
                          {{ trans('common.total') }}
                        </span>
                      </div>
                    </div>
                    <?php $total = 0; ?>
                    <ul class="qty">
                      @foreach ($cartItems as $item)
                        <?php $product = App\Models\Product::find($item['product_id']); ?>
                        @if ($product != '')
                          <li>
                            <h4> {{ $product['name_'.$lang] }} :
                              <span>
                                  {{ $item['total'] . ' ' . getDefaultCurrencySypml() }}  {{ ' * ' . $item['quantity'] }}
                                  @if ($item['optionsTotal'] > 0)
                                    <small class="mt-1 d-block text-black-50">+ {{$item['optionsTotal']}} اختيارات إضافية</small>
                                  @endif
                                  @if ($product->taxTotal() > 0)
                                    <small class="mt-1 d-block text-black-50">+ {{$product->taxTotal()}} ضريبة المنتج</small>
                                  @endif
                              </span>
                            </h4>
                          </li>
                        @endif
                      @endforeach
                    </ul>
                    <ul class="sub-total">
                      <li>{{ trans('common.coupon') }}
                        <div class="shipping">
                          <div class="shipping-option">
                            <div class="form-group">
                              <input type="text" class="form-control coupon_text @error('coupon') is-invalid @enderror" name="coupon"
                                placeholder="{{ trans('common.couponCode') }}" onchange="checkCode(this.value)">
                              <span class="form-control-feedback" id="couponCode"></span>
                            </div>
                          </div>
                        </div>
                      </li>
                    </ul>
                    <ul class="total">
                      <li>{{ trans('common.total') }}
                        <span id="totalShopping" class="count" data-totalPrice="{{ getCart()['total'] }}">{{ getCart()['total'] . ' ' . getDefaultCurrencySypml() }}</span>
                        <input type="hidden" name="totalPrice" id="totalPrice" value="{{ getCart()['total'] }}">
                        <input type="hidden" name="shippingPrice" id="shippingPrice" value="0">
                      </li>
                      <li>{{ trans('common.shipping') }}
                        <span id="totalShipping" class="count">0</span>
                      </li>
                    </ul>
                  </div>
                    <div class="payment-box">

                    <div class="text-end">
                      <button class="btn-solid btn" type="submit">
                        {{ trans('common.PlaceOrder') }}
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </form>
      </div>
    </div>
  </div>
</section>
<!-- section end -->
@stop

