 <!-- Parallax banner -->
    <section class="section-b-space dark-overlay">
        {{--<img src="{{asset('frontend/assets/images/books/product-bg.jpg')}}" alt="" class="bg-img blur-up lazyload">--}}
        <div class="ratio_square">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="title2">
                            <h2 class="title-inner2">
                              {{ getSettingValue('categoriesTitle_'.$lang) }}
                            </h2>
                        </div>
                    </div>
                </div>
                <div class="row margin-default">
                  @forelse ($categories as $category)
                    <div class="col-lg-4">
                        <div class="theme-card card-border bg-white">
                            <h5 class="title-border">
                              {{ $category['name_'.$lang] }}
                            </h5>
                            <div class="offer-slider slide-1">
                             @for ($x=0;$x<4;$x++)

                                 @php
                                   $products = $category->products->skip($x)->take(2);
                                 @endphp
                                 @if (count($products) > 0)
                                   <div class="p-1">
                                       @forelse ($products as $product)
                                       <div class="media">
                                           <a href="{{ route('product.details', ['product'=>$product->id]) }}">
                                               <img alt="" class="img-fluid blur-up lazyload" src="{{asset('uploads/products/'.$product->id.'/'.$product->mainImage)}}">
                                           </a>
                                           <div class="media-body align-self-center">
                                               {{-- <div class="rating">
                                                   <i class="fa fa-star"></i>
                                                   <i class="fa fa-star"></i>
                                                   <i class="fa fa-star"></i>
                                                   <i class="fa fa-star"></i>
                                                   <i class="fa fa-star"></i>
                                               </div> --}}
                                               <a href="{{ route('product.details', ['product'=>$product->id]) }}">
                                                   <h6>
                                                       {{ $product['name_'.$lang] }}
                                                   </h6>
                                               </a>
                                               <h4>
                                                   {{ $product->price .' '. getDefaultCurrencySypml() }}
                                               </h4>
                                           </div>
                                       </div>
                                       @empty
                                       <div class="col-12">
                                           <h3 class="text-center">
                                               {{ trans('common.nothingToView')}}
                                           </h3>
                                       </div>
                                       @endforelse
                                   </div>
                                 @endif
                             @endfor
                            </div>
                        </div>
                    </div>
                  @empty
                    <div class="col-12">
                      <h3 class="text-center">
                        {{ trans('common.nothingToView')}}
                      </h3>
                    </div>
                  @endforelse

                </div>
            </div>
        </div>
    </section>
    <!-- Parallax banner end -->


