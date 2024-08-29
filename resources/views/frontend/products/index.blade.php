@extends('frontend.layouts.master')
@section('content')
{{-- صفحة المنتجات --}}
<!-- section start -->
<section class="section-b-space ratio_asos">
  <div class="collection-wrapper">
    <div class="container">
      <div class="row">
        <div class="col-sm-3 collection-filter">
          <!-- side-bar colleps block stat -->
          <div class="collection-filter-block">
            <!-- brand filter start -->
            <div class="collection-mobile-back">
              <span class="filter-back"><i class="ti-close" aria-hidden="true"></i></span>
            </div>
            <form method="GET" action="{{ route('e-commerce.products') }}">
              {{-- <div class="collection-collapse-block open">
                <h3 class="collapse-block-title">{{ trans('common.companies') }}</h3>
              <div class="collection-collapse-block-content">
                <div class="collection-brand-filter">
                  @foreach ($companies as $key => $company)
                  <div class="form-check collection-filter-checkbox">
                    <input type="checkbox" class="form-check-input" id="company_{{ $company }}" name="company_id[]" value="{{ $key }}" onchange="this.form.submit()" {{ (isset($_GET['company_id'])==$key &&
                          in_array($key, $_GET['company_id'])) ? 'checked' : '' }}>
                    <label class="form-check-label" for="company_{{ $company }}">
                      {{ $company }}
                    </label>
                  </div>
                  @endforeach
                </div>
              </div>
          </div> --}}
          <div class="collection-collapse-block open">
            <h3 class="collapse-block-title">{{ trans('common.categories') }}</h3>
            <div class="collection-collapse-block-content">
              <div class="collection-brand-filter">

                @foreach ($categories as $key => $category)
                <div class="form-check collection-filter-checkbox">
                  <input type="checkbox" class="form-check-input" id="cat_{{ $category }}" name="category_id[]" value="{{ $key }}" onchange="this.form.submit()" {{ (isset($_GET['category_id'])==$key &&
                        in_array($key,$_GET['category_id'])) ? 'checked' : '' }}>
                  <label class="form-check-label" for="cat_{{ $category }}">
                    {{ $category }}
                  </label>
                </div>
                @endforeach
              </div>
            </div>
          </div>
          </form>
        </div>
        <!-- silde-bar colleps block end here -->
        <!-- side-bar single product slider start -->
        <div class="theme-card">
          <h5 class="title-border">{{ trans('common.newProducts') }}</h5>
          <div class="offer-slider slide-1">
            <?php $row = 0 ?>
            @for($i = 0; $i < 3; $i++) <div>
              @php
              $newProducts1 = $newProducts->skip($row)->take(3);
              @endphp
              @foreach ($newProducts1 as $product)
              <div class="media">
                <a href="{{ route('product.details', ['product'=>$product->id,'slug'=>$product->slugName()]) }}">
                  <img class="img-fluid blur-up lazyload" src="{{asset('uploads/products/'.$product->id.'/'.$product->mainImage)}}" alt="">
                </a>
                <div class="media-body align-self-center">
                  <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                  </div><a href="product-page(no-sidebar).html">
                    <h6>
                      {{ $product['name_'.$lang] }}
                    </h6>
                  </a>
                  <h4>
                    {{ $product->checkDiscount($product->price, $product->quantity).' '. getDefaultCurrencySypml() }}
                  </h4>
                </div>
              </div>
              @endforeach
          </div>
          <?php $row += 3 ?>
          @endfor
        </div>
      </div>
      <!-- side-bar single product slider end -->
      <!-- side-bar banner start here -->


      <!-- side-bar banner end here -->
    </div>
    <div class="collection-content col-sm-9">
      <div class="page-main-content">
        <div class="row">
          <div class="col-sm-12">
            @if(getSettingImageLink('productsMainImage'))
              <div class="top-banner-wrapper">
                <a href="#">
                  <img src="{{ getSettingImageLink('productsMainImage') }}" class="img-fluid blur-up lazyload" alt="" width="100%">
                </a>
              </div>
            @endif
            <div class="collection-product-wrapper">
              <div class="product-top-filter">
                <div class="row">
                  <div class="col-xl-12">
                    <div class="filter-main-btn">
                      <span class="filter-btn btn btn-theme">
                        <i class="fa fa-filter" aria-hidden="true"></i>
                        {{trans('common.search')}}
                      </span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="product-wrapper-grid">
                <div class="row margin-res game-product">
                  @foreach ($products as $product)
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
                            @endforeach
                </div>

                <div class="product-pagination">
                  <div class="theme-paggination-block">
                    <div class="row">
                      <div class="col-xl-6 col-md-6 col-sm-12">
                        <nav aria-label="Page navigation">
                          <ul class="pagination">

                            <li class="page-item">
                              <a class="page-link" href="{{$products->previousPageUrl()}}" aria-label="Previous">
                                <span aria-hidden="true"> <i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                                <span class="sr-only">{{ trans('common.Previous') }}</span>
                              </a>
                            </li>
                            @for($i = 1; $i <= $products->lastPage(); $i++)
                              <li class="page-item {{ $products->currentPage() == $i ? 'active' : '' }}">
                                <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                              </li>
                              @endfor
                              <li class="page-item"><a class="page-link" href="{{ $products->nextPageUrl() }}" aria-label="Next">
                                  <span aria-hidden="true">
                                    <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                  </span>
                                  <span class="sr-only">{{ trans('common.Next') }}</span></a></li>
                          </ul>
                        </nav>
                      </div>
                      <div class="col-xl-6 col-md-6 col-sm-12">
                        <div class="product-search-count-bottom">
                          <h5>{{ trans('common.ShowingProducts') }}</h5>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
<!-- section End -->


@stop
