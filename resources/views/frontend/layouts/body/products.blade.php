<!-- Paragraph-->
<div class="title1 section-t-space">
  <h2 class="title-inner1">{{ getSettingValue('productsTitle_'.app()->getLocale()) }}</h2>
</div>
<div class="container">
  <div class="row">
    <div class="col-lg-6 offset-lg-3">
      <div class="product-para">
        <p class="text-center">
          {{ getSettingValue('productsDescription_'.app()->getLocale()) }}
        </p>
      </div>
    </div>
  </div>
</div>
<!-- Paragraph end -->


<!-- Product section -->
<section class="pt-0 section-b-space ratio_asos">
  <div class="container">
    <div class="row game-product grid-products">

      @forelse ($products as $product)
        <div class="product-box col-12 col-sm-6 col-md-4 col-lg-3">
          <div class="img-wrapper">
            <div class="front">
              <a href="{{ route('product.details',['product'=>$product->id,'slug'=>$product->slugName()]) }}">
                <img src="{{ asset('uploads/products/'.$product->id.'/'.$product->mainImage) }}"
                  class="img-fluid blur-up lazyload bg-img" alt="">
              </a>
            </div>
            @if (auth()->check())
              <div class="cart-info cart-wrap">
                <button title="{{ trans('common.addToWishlist') }}"
                        data-product-id="{{ $product->id }}" type="button"
                        onclick="addToFav(this)">
                      <i class="ti-heart" aria-hidden="true"></i>
                </button>
              </div>
            @else
              <div class="cart-info cart-wrap">
                <form method="POST" action="{{ route('wishlist.add') }}">
                  @csrf
                  <input type="hidden" name="product_id" value="{{ $product->id }}">
                  <button type="submit" title="{{ trans('common.addToWishlist') }}">
                    <i class="ti-heart" aria-hidden="true"></i>
                  </button>
                </form>
             </div>
            @endif

            <button title="{{ trans('common.addToCart') }}" class="add-button addCart"
                    data-product-id="{{ $product->id }}" type="button" style="z-index: 1000; position: initial;"
                    onclick="addToCart(this)">
              <i class="ti-shopping-cart"></i>
              {{ trans('common.addToCart') }}
            </button>

            {{-- <button title="{{ trans('common.addToCart') }}" class="add-button addCart" data-product-id="{{ $product->id }}"
              data-quantity="1" type="submit" style="z-index: 1000" value="{{ $product->id }}">
              <i class="ti-shopping-cart"></i>
            </button> --}}



          </div>
          <div class="product-detail">
            <div class="rating">
              {{-- {{ $product->countReviews()  }} --}}
              @for($i = 0; $i < $product->countReviews(); $i++)
                <i class="fa fa-star" style="color: gold;"></i>
              @endfor
            </div>
            <a href="{{ route('product.details',['product'=>$product->id,'slug'=>$product->slugName()]) }}">
              <h6>{{ $product['name_'.$lang] }}</h6>
            </a>
            <h4>{{ $product->checkDiscount($product->price, $product->quantity).' '. getDefaultCurrencySypml()}}</h4>
          </div>
        </div>
      @empty
        <div class="col-12">
          <h2 class="text-center"> {{trans('common.nothingToView')}} </h2>
        </div>
      @endforelse
          <div class="col-12">

            <a href="{{ route('e-commerce.products') }}" class="btn btn-solid mx-auto" style="width: 200px; display:flex; justify-content:center;">
              {{ trans('common.more') }}
            </a>
          </div>

    </div>
  </div>
</section>
<!-- Product section end -->

