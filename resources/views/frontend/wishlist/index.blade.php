@extends('frontend.layouts.master')
@section('content')
  @include('frontend.layouts.topbar.breadcrumbs')
  <!--section start-->
  <section class="wishlist-section section-b-space">
    <div class="container">
      <div class="row">
        <div class="col-sm-12 table-responsive-xs">
          <table class="table cart-table">
            <thead>
              <tr class="table-head">
                <th scope="col">{{ trans('common.image') }}</th>
                <th scope="col">{{ trans('common.product_name') }}</th>
                <th scope="col">{{ trans('common.price') }}</th>
                <th scope="col">{{ trans('common.actions') }}</th>
              </tr>
            </thead>
            <tbody >
              @forelse ($wishlists as $wishlist)
              @if($wishlist->product != '' )
              <tr>
                <td class="text-center">
                  <a href="{{route('product.details',$wishlist->product->id)}}"><img src="{{ $wishlist->product->photoLink() }}" alt=""></a>
                </td>
                <td class="text-center">
                  <a href="{{ route('product.details', ['product'=> $wishlist->product->id ]) }}">
                    {{$wishlist->product['name_'.$lang] }}
                  </a>
                </td>
                <td class="text-center">
                  <h2>
                    <span>{{ $wishlist->product->price }}</span>
                  </h2>
                </td>
                <td class="text-center">
                  <form action="{{ route('wishlist.delete', ['wishlist'=>$wishlist->id ]) }}" method="POST" >
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">
                      <i class="ti-close"></i>
                    </button>
                  </form>
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
        </div>
      </div>
      <div class="row wishlist-buttons">
        <div class="col-12">
            <a href="{{route('e-commerce.products')}}" class="btn btn-solid">{{ trans('common.continueShopping') }}</a>
        </div>
    </div>
  </section>
  <!--section end-->
@stop
