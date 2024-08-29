@extends('frontend.layouts.master')
@section('content')
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
              <span class="filter-back"><i class="fa fa-angle-left" aria-hidden="true"></i> back</span>
            </div>
            <div class="collection-collapse-block open">
              <h3 class="collapse-block-title">{{ trans('common.companies') }}</h3>
              <div class="collection-collapse-block-content">
                <div class="collection-brand-filter">
                  @foreach ($companies as $company)
                  <div class="form-check collection-filter-checkbox">
                    <input type="checkbox" class="form-check-input" id="{{ $company }}" name="{{ $company }}"
                      value="{{ $company }}">
                    <label class="form-check-label" for="{{ $company }}">
                      {{ $company }}
                    </label>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="collection-collapse-block open">
              <h3 class="collapse-block-title">{{ trans('common.categories') }}</h3>
              <div class="collection-collapse-block-content">
                <div class="collection-brand-filter">
                  @foreach ($AllCategories as $category)
                  <div class="form-check collection-filter-checkbox">
                    <input type="checkbox" class="form-check-input" id="{{ $category }}" name="{{ $category }}"
                      value="{{ $category }}">
                    <label class="form-check-label" for="{{ $category }}">
                      {{ $category }}
                    </label>
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
            {{--
            <!-- color filter start here -->
            <div class="collection-collapse-block open">
              <h3 class="collapse-block-title">colors</h3>
              <div class="collection-collapse-block-content">
                <div class="color-selector">
                  <ul>
                    <li class="color-1 active"></li>
                    <li class="color-2"></li>
                    <li class="color-3"></li>
                    <li class="color-4"></li>
                    <li class="color-5"></li>
                    <li class="color-6"></li>
                    <li class="color-7"></li>
                  </ul>
                </div>
              </div>
            </div>
            <!-- size filter start here --> --}}
            {{-- <div class="collection-collapse-block border-0 open">
              <h3 class="collapse-block-title">size</h3>
              <div class="collection-collapse-block-content">
                <div class="collection-brand-filter">
                  <div class="form-check collection-filter-checkbox">
                    <input type="checkbox" class="form-check-input" id="hundred">
                    <label class="form-check-label" for="hundred">s</label>
                  </div>
                  <div class="form-check collection-filter-checkbox">
                    <input type="checkbox" class="form-check-input" id="twohundred">
                    <label class="form-check-label" for="twohundred">m</label>
                  </div>
                  <div class="form-check collection-filter-checkbox">
                    <input type="checkbox" class="form-check-input" id="threehundred">
                    <label class="form-check-label" for="threehundred">l</label>
                  </div>
                  <div class="form-check collection-filter-checkbox">
                    <input type="checkbox" class="form-check-input" id="fourhundred">
                    <label class="form-check-label" for="fourhundred">xl</label>
                  </div>
                </div>
              </div>
            </div> --}}
            <!-- price filter start here -->
            <div class="collection-collapse-block border-0 open">
              <h3 class="collapse-block-title">{{ trans('common.price') }}</h3>
              <div class="collection-collapse-block-content">
                <div class="wrapper mt-3">
                  <div class="range-slider">
                    <label class="range-slider__label" for="priceFrom">{{ trans('common.from') }}</label>
                    <input type="number" class="js-range-slider" name="priceFrom" id="priceFrom" min="0" />
                  </div>
                </div>
                <div class="wrapper mt-3">
                  <div class="range-slider p-2">
                    <label class="range-slider__label" for="priceTo">{{ trans('common.to') }}</label>
                    <input type="number" class="js-range-slider" name="priceTo" id="priceTo" min="0" />
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- silde-bar colleps block end here -->
          <!-- side-bar single product slider start -->
          <div class="theme-card">
            <h5 class="title-border">new product</h5>
            <div class="offer-slider slide-1">
              <div>
                <div class="media">
                  <a href=""><img class="img-fluid blur-up lazyload" src="../assets/images/fashion/pro/1.jpg"
                      alt=""></a>
                  <div class="media-body align-self-center">
                    <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                    </div><a href="product-page(no-sidebar).html">
                      <h6>Green Printed Dresses</h6>
                    </a>
                    <h4>30.00</h4>
                  </div>
                </div>
                <div class="media">
                  <a href=""><img class="img-fluid blur-up lazyload" src="../assets/images/fashion/pro/011.jpg"
                      alt=""></a>
                  <div class="media-body align-self-center">
                    <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                    </div><a href="product-page(no-sidebar).html">
                      <h6>Pink Printed Dresses</h6>
                    </a>
                    <h4>$35.00</h4>
                  </div>
                </div>
                <div class="media">
                  <a href=""><img class="img-fluid blur-up lazyload" src="../assets/images/fashion/pro/16.jpg"
                      alt=""></a>
                  <div class="media-body align-self-center">
                    <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                    </div><a href="product-page(no-sidebar).html">
                      <h6>Solid Green Dresses</h6>
                    </a>
                    <h4>$33.00</h4>
                  </div>
                </div>
              </div>
              <div>
                <div class="media">
                  <a href=""><img class="img-fluid blur-up lazyload" src="../assets/images/fashion/pro/001.jpg"
                      alt=""></a>
                  <div class="media-body align-self-center">
                    <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                    </div><a href="product-page(no-sidebar).html">
                      <h6>black White Printed Dresses</h6>
                    </a>
                    <h4>$32.00</h4>
                  </div>
                </div>
                <div class="media">
                  <a href=""><img class="img-fluid blur-up lazyload" src="../assets/images/fashion/pro/4.jpg"
                      alt=""></a>
                  <div class="media-body align-self-center">
                    <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                    </div><a href="product-page(no-sidebar).html">
                      <h6>Dotted Black Dresses</h6>
                    </a>
                    <h4>$38.00</h4>
                  </div>
                </div>
                <div class="media">
                  <a href=""><img class="img-fluid blur-up lazyload" src="../assets/images/fashion/pro/19.jpg"
                      alt=""></a>
                  <div class="media-body align-self-center">
                    <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i>
                      <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                    </div><a href="product-page(no-sidebar).html">
                      <h6>Blue Printed Dresses</h6>
                    </a>
                    <h4>$36.00</h4>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- side-bar single product slider end -->
          <!-- side-bar banner start here -->
          @foreach ($categories as $category)
          <div class="collection-sidebar-banner">
            <a href="#"><img src="{{ $category->photoLink() }}" class="img-fluid blur-up lazyload" alt=""></a>
          </div>
          @endforeach
          <!-- side-bar banner end here -->
        </div>
        <div class="collection-content col">
          <div class="page-main-content">
            <div class="row">
              <div class="col-sm-12">
                <div class="top-banner-wrapper">
                  @foreach ($products as $product)
                  <a href="#"><img src="{{ $product->photoLink() }}" class="img-fluid blur-up lazyload" alt=""
                      style="height: 400px;" width="100%"></a>
                  <div class="top-banner-content small-section">
                    <h4>{{ $product['name_'.$lang] }}</h4>
                    <p> {{ $product['description_'.$lang] }}</p>
                  </div>
                  @endforeach
                </div>
                <div class="collection-product-wrapper">
                  <div class="product-top-filter">
                    <div class="row">
                      <div class="col-xl-12">
                        <div class="filter-main-btn"><span class="filter-btn btn btn-theme"><i class="fa fa-filter"
                              aria-hidden="true"></i> Filter</span></div>
                      </div>
                    </div>
                  </div>
                  @if(isset($_GET['category_id']))
                    <div class="product-wrapper-grid">
                      <div class="row margin-res">
                        @foreach ($products as $product)
                          <div class="col-xl-3 col-6 col-grid-box">
                            <div class="product-box">
                              <div class="img-wrapper">
                                <div class="front">
                                  <a href="{{ route('product.details', ['product'=>$product->id]) }}"><img
                                      src="{{ $product->photoLink() }}" class="img-fluid blur-up lazyload bg-img"
                                      alt=""></a>
                                </div>
                                <div class="back">
                                  <a href="{{ route('product.details', ['product'=>$product->id]) }}"><img
                                      src="{{ $product->photoLink() }}" class="img-fluid blur-up lazyload bg-img"
                                      alt=""></a>
                                </div>
                                <div class="cart-info cart-wrap">
                                  <button title="Add to cart" onclick="addToCart({{ $product->id }})"><i
                                      class="ti-shopping-cart"></i></button> <a href="javascript:void(0)"
                                    title="Add to Wishlist" onclick="addToWishlist({{ $product->id }})"><i class="ti-heart"
                                      aria-hidden="true"></i></a> <a href="javascript:void(0)" data-toggle="modal"
                                    data-target="#quick-view" title="Quick View"><i class="ti-search"
                                      aria-hidden="true"></i></a>
                                </div>
                              </div>
                              <div class="product-detail">
                                <div>
                                  <a href="{{ route('product.details', ['product'=>$product->id]) }}">
                                    <h6>{{ $product['name_'.$lang] }}</h6>
                                  </a>
                                  <h4>{{ trans('common.price') . ' : ' . $product->price . trans('common.LE')}} </h4>
                                </div>
                              </div>
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
                                  <li class="page-item"><a class="page-link" href="#" aria-label="Previous"><span
                                        aria-hidden="true"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
                                      <span class="sr-only">Previous</span></a></li>
                                  <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                  <li class="page-item"><a class="page-link" href="#">2</a></li>
                                  <li class="page-item"><a class="page-link" href="#">3</a></li>
                                  <li class="page-item"><a class="page-link" href="#" aria-label="Next"><span
                                        aria-hidden="true"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
                                      <span class="sr-only">Next</span></a></li>
                                </ul>
                              </nav>
                            </div>
                            <div class="col-xl-6 col-md-6 col-sm-12">
                              <div class="product-search-count-bottom">
                                <h5>Showing Products 1-24 of 10 Result</h5>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  @endif
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
