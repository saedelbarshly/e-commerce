@extends('frontend.layouts.master')
@section('content')
<!-- breadcrumb start -->
@include('frontend.layouts.topbar.breadcrumbs')
<!-- breadcrumb End -->
<!--section start-->
<section class="cart-section section-b-space mb-5 pt-2">
  <div class="container">
    @if (count($cartItems) > 0)
        <div class="row">
          <div class="col-sm-12">
            @if(session()->has('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert"
              style="background-color: #d4edda; color: #155724; border-color: #c3e6cb; text-align: center;">
              <strong>{{ session()->get('success') }}</strong> .
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            {{--
            <div class="cart_counter">
              <div class="countdownholder">
                {{ trans('common.YourCartWillBeExpiredIn') }}
                <span id="timer"></span>{{ trans('common.minutes!') }}
              </div>
              <a href="{{ route('e-commerce.checkout') }}" class="cart_checkout btn btn-solid btn-xs">
                {{ trans('common.checkOut') }}
              </a>
            </div>
            --}}
          </div>
          <div class="col-sm-12 table-responsive-xs">
            <table class="table cart-table">
              <thead>
                <tr class="table-head">
                  <th scope="col">{{ trans('common.image') }}</th>
                  <th scope="col">{{ trans('common.product_name') }}</th>
                  <th scope="col">{{ trans('common.price') }}</th>
                  <th scope="col">{{ trans('common.quantity') }}</th>
                  <th scope="col">{{ trans('common.actions') }}</th>
                  <th scope="col">{{ trans('common.total') }}</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($cartItems as $item)
                  <?php $product_details = App\Models\Product::find($item['product_id']); ?>
                    @if($product_details != '')
                      <tr class="deleteDiv{{$item['id']}} text-center">
                        <td class="text-center">
                          <a href="{{ route('product.details', ['product'=> $item['product_id']]) }}">
                            <img src="{{ asset($product_details->photoLink()) }}" alt="">
                          </a>
                        </td>
                        <td class="text-center">
                          <a href="{{route('product.details',$product_details->id)}}">
                            {{ $product_details['name_'.$lang] }}
                          </a>
                        </td>
                        <td class="text-center">
                          <h2 class="mb-0">
                            <span class='thePrice d-none' data-itemid="{{ $product_details['id'] }}">
                              {{$product_details->realPriceAfterDiscount()}}
                            </span>

                            @if ($product_details->realPriceAfterDiscount() < $product_details->price)
                                <del>{{$product_details->price}}</del>
                            @endif
                            {{ $product_details->realPriceAfterDiscount() }}
                            {{ getDefaultCurrencySypml() }}
                          </h2>

                          @if ($item['optionsTotal'] > 0)
                            <small class="mt-1 d-block">+ {{$item['optionsTotal']}} اختيارات إضافية</small>
                          @endif
                          @if ($product_details->taxTotal() > 0)
                            <small class="mt-1 d-block">+ {{$product_details->taxTotal()}} ضريبة المنتج</small>
                          @endif
                        </td>
                        <td>
                          <div class="qty-box">
                            <div class="input-group">
                              <span class="input-group-prepend">
                                <button type="submit" value="{{ $product_details->id }}" class="btn cartDecrement quantity-left-minus" onclick="changeCartQuantity('decrease',this)" data-type="minus"
                                  data-field="">
                                  -
                                </button>
                              </span>
                              <input type="number" name="quantity" class="form-control input-number quantity"
                                value="{{ $item['quantity'] }}">
                              <span class="input-group-prepend">
                                <button type="submit" value="{{$product_details->id }}" class="btn cartIncrement quantity-right-plus" onclick="changeCartQuantity('increase',this)" data-type="plus"
                                  data-field="">
                                  +
                                </button>
                              </span>
                            </div>
                          </div>
                        </td>
                        <td class="text-center">
                          <button type="button" onclick="deleteFromCart('{{$item['id']}}')" class="btn btn-sm btn-danger">
                            <i class="ti-close"></i>
                          </button>
                        </td>
                        <td class="text-center">
                          <h2 class="td-color" id="itemTotal">
                            @if ($product_details->realPriceAfterDiscount() < $product_details->price)
                            <del>{{$product_details->price * $item['quantity']}}</del>
                            @endif
                            {{ $product_details->realPriceAfterDiscount()*($item['quantity']) + ($item['optionsTotal']) + ($product_details->taxTotal())}}
                            {{ getDefaultCurrencySypml() }}
                          </h2>
                        </td>
                      </tr>
                    @endif
                @empty
                <tr class="trext-center">
                  <th colspan="6">
                    {{ trans('common.nothingToView') }}
                  </th>
                </tr>
                @endforelse
              </tbody>
            </table>
            <div class="table-responsive-md">
              <table class="table cart-table ">
                <tfoot>
                  <tr>
                    <td>{{ trans('common.total') }} :</td>
                    <td>
                      <h2 class="cartTotal">
                        {{ getCart()['total'] . ' ' . getDefaultCurrencySypml() }}
                      </h2>
                    </td>
                  </tr>
                  <tr>
                    <td></td>
                    <td>
                      <a href="{{ route('e-commerce.checkout') }}" class="btn btn-solid">{{ trans('common.Confirm Order') }}</a>
                    </td>
                  </tr>
                </tfoot>
              </table>
            </div>
          </div>
        </div>
        <div class="row cart-buttons ">
          {{-- <div class="col-6">
            <a href="{{ route('e-commerce.products') }}" class="btn btn-solid">{{ trans('common.continueShopping') }}</a>
          </div>
          <div class="col-6">
            <a href="{{ route('e-commerce.checkout') }}" class="btn btn-solid">{{ trans('common.checkOut') }}</a>
          </div> --}}
        </div>

    @else
      <div class="row cart-buttons justify-content-center">
        <div class="col-6 text-center">
          <img src="{{asset('frontend/assets/images/empty-cart.png')}}" alt="" class="w-75">
          <br>
          <a href="{{ route('e-commerce.products') }}" class="btn btn-solid">{{ trans('common.continueShopping') }}</a>
        </div>
      </div>
    @endif
  </div>
</section>
<!--section end-->
@stop
