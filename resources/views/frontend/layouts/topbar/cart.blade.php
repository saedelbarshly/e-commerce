<li class="onhover-div mobile-cart">
    <div>
        <img src="{{asset('frontend/assets/images/icon/cart.png')}}" class="img-fluid blur-up lazyload" alt="">
        <i class="ti-shopping-cart"></i>
    </div>
    <span class="cart_qty_cls">
       {{ getCart()['count_items']  }}
    </span>
    <ul class="show-div shopping-cart shopping-cart-items headerShoppingCart">
        @foreach(getCart()['items'] as $item)
            <?php $product = App\Models\Product::find($item['product_id']); ?>
            <li class=" deleteDiv{{$item['product_id']}} headerCartItem">
                <div class="media">
                    <a href="{{ route('product.details', ['product'=> $item['product_id']]) }}">
                        <img alt="" class="me-3" src="{{ asset($product->photoLink()) }}">
                    </a>
                    <div class="media-body">
                        <a href="{{ route('product.details', ['product'=> $item['product_id']]) }}">
                            <h4>{{ $product['name_'.$lang] }}</h4>
                        </a>
                        <h4>
                            <span>
                                {{ $item['total'] . getDefaultCurrencySypml() }}  {{ ' * ' . $item['quantity'] }}
                            </span>
                        </h4>
                        @if ($item['optionsTotal'] > 0)
                          <small class="mt-1">+ {{$item['optionsTotal']}} اختيارات إضافية</small>
                        @endif
                        @if ($product->taxTotal() > 0)
                          <small class="mt-1 d-block">+ {{$product->taxTotal()}} ضريبة المنتج</small>
                        @endif
                    </div>
                </div>
                <div class="close-circle">
                    <button type="button"  onclick="deleteFromCart('{{$item['id']}}')" class="btn btn-sm btn-danger">
                      <i class="fa fa-times" aria-hidden="true">
                      </i>
                    </button>
                </div>
            </li>
        @endforeach
        <li>
          <div class="total">
            <h5>
              {{ trans('common.total') }}
              <span class="cartTotal">
                {{ getCart()['total']  . ' '. getDefaultCurrencySypml()}}
              </span>
            </h5>
          </div>
        </li>
        <li>
          <div class="buttons">
            <a href="{{ route('e-commerce.cart') }}" class="view-cart btn btn-sm btn-solid">
                {{ trans('common.viewCart') }}
            </a>
            <a href="{{ route('e-commerce.checkout') }}" class="checkout btn btn-sm btn-solid">
                {{ trans('common.checkOut') }}
            </a>
          </div>
        </li>
    </ul>
</li>

