@foreach(getCart()['items'] as $item)
@if(isset($item->product))
  <li class=" deleteDiv{{$item->id}}">
      <div class="media">
          <a href="{{ route('product.details', ['product'=> $item->product->id]) }}">
              <img alt="" class="me-3" src="{{ asset($item->product->photoLink()) }}">
          </a>
          <div class="media-body">
              <a href="{{ route('product.details', ['product'=> $item->product->id]) }}">
                  <h4>{{ $item->product['name_'.$lang] }}</h4>
              </a>
              <h4>
                  <span>
                      {{ $item->totals() . getDefaultCurrencySypml() }}  {{ ' * ' . $item->quantity }}
                  </span>
              </h4>
          </div>
      </div>
      <div class="close-circle">
          <button type="button"  onclick="deleteFromCart('{{$item->id}}')" class="btn btn-sm btn-danger">
            <i class="fa fa-times" aria-hidden="true">
            </i>
          </button>
      </div>
  </li>
@endif
@endforeach
<li>
<div class="total">
  <h5>{{ trans('common.total') }}  <span class="cartTotal">{{ getCart()['total']  . ' '. getDefaultCurrencySypml()}}</span></h5>
</div>
</li>
<li>
<div class="buttons">
  <a href="{{ route('e-commerce.cart') }}" class="view-cart">
    {{ trans('common.viewCart') }}
  </a>
  <a href="{{ route('e-commerce.checkout') }}" class="checkout">
  {{ trans('common.checkOut') }}
  </a>
</div>
</li>

