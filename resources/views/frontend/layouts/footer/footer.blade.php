<!-- footer section start -->
<footer class="dark-footer footer-style-1">
  @include('frontend/layouts/footer/section')
  <div class="sub-footer dark-subfooter">
    <div class="container">
      <div class="p-0 m-0 row justify-content-center">
        <div class="p-0 m-0 col-12 col-md-3 col-xl-4 ">
          <div class="footer-end">
            <p>
              <i class="fa fa-copyright" aria-hidden="true"></i>
              {{ getSettingValue('siteTitle_'.$lang) }}
            </p>
          </div>
        </div>
        <div class="p-0 m-0  col-12 col-md-3 col-xl-4">
          <div style="text-align: center;">
            <p>
              <span style="display: inline-block;">{{ trans('common.PoweredByTechnmasr') }}</span>
            </p>
          </div>
        </div>
        <div class="p-0 m-0  col-12 col-md-3 col-xl-4">

          <div class="payment-card-bottom">
            <ul class="p-0 m-0">
              @for ($i = 1; $i <=5 ; $i++) @if (getSettingValue('paymentImage_'.$i) !='' ) <li>
                <a href="#">
                  <img src="{{ asset('uploads/settings/'.getSettingValue('paymentImage_'.$i) ) }}" alt="">
                </a>
                </li>
                @endif
                @endfor
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</footer>
<!-- footer section end -->


<!-- search section -->
<div id="search-overlay" class="search-overlay">
  <div> <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>
    <div class="overlay-content">
      <div class="container">
        <div class="row">
          <div class="col-xl-12">
            <form method="GET" action="{{route('e-commerce.products')}}">
              <div class="form-group search-container">
                <input type="text" name="name" class="form-control" id="exampleInputPassword1" placeholder="{{ trans('common.SearchAnythingHere') }}">
              </div>
              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- search section -->





<!-- Quick-view modal popup start-->
{{-- <div class="modal fade bd-example-modal-lg theme-modal" id="quick-view" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content quick-view-modal">
      <div class="modal-body">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
        <div class="row">
          <div class="col-lg-6 col-xs-12">
            <div class="quick-view-img"><img src="{{ asset('frontend/assets/images/pro3/1.jpg') }}" alt=""
class="img-fluid blur-up lazyload"></div>
</div>
<div class="col-lg-6 rtl-text">
  <div class="product-right">
    <h2>Women Pink Shirt</h2>
    <h3>$32.96</h3>
    <ul class="color-variant">
      <li class="bg-color1"></li>
      <li class="bg-color3"></li>
    </ul>
    <div class="border-product">
      <h6 class="product-title">product details</h6>
      <p>Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium
        doloremque laudantium</p>
    </div>
    <div class="product-description border-product">
      <div class="size-box">
        <ul>
          <li class="active"><a href="javascript:void(0)">s</a></li>
          <li><a href="javascript:void(0)">m</a></li>
          <li><a href="javascript:void(0)">l</a></li>
          <li><a href="javascript:void(0)">xl</a></li>
        </ul>
      </div>
      <h6 class="product-title">quantity</h6>
      <div class="qty-box">
        <div class="input-group"><span class="input-group-prepend"><button type="button" class="btn quantity-left-minus" data-type="minus" data-field=""><i class="ti-angle-left"></i></button> </span>
          <input type="text" name="quantity" class="form-control input-number" value="1"> <span class="input-group-prepend"><button type="button" class="btn quantity-right-plus" data-type="plus" data-field=""><i class="ti-angle-right"></i></button></span>
        </div>
      </div>
    </div>
    <div class="product-buttons"><a href="#" class="btn btn-solid">add to cart</a> <a href="#" class="btn btn-solid">view detail</a></div>
  </div>
</div>
</div>
</div>
</div>
</div>
</div> --}}
<!-- Quick-view modal popup end-->


<!-- theme setting -->

@include('frontend/layouts/footer/theme')
<!-- theme setting -->


<!-- tap to top -->
<a class="whatsappIcon" target="_blank" href="https://wa.me/{{ getSettingValue('phone') }}">
  <i class="fa-brands fa-whatsapp d-block my-4"></i>
</a>
<a target="_blank" href="https://wa.me/{{ getSettingValue('phone') }}" style="position: fixed;display: flex;justify-content: center;right: 30px;align-items: center;bottom:5px;background-color:#c1aa72 ;width: 46px;height: 46px;color: white;font-size: 20px;border-radius: 50%;border-reduis:50%;">
  <i class="fa-solid fa-phone"></i>
</a>
<div class="tap-top top-cls my-4">
  <div>
    <i class="fa fa-angle-double-up"></i>
  </div>
</div>
<!-- tap to top end -->
<!-- latest jquery-->
<script src="{{ asset('frontend/assets/js/jquery-3.3.1.min.js') }}"></script>
<script src="https://kit.fontawesome.com/cc1d849379.js" crossorigin="anonymous"></script>
<!-- slick js-->
<script src="{{ asset('frontend/assets/js/slick.js') }}"></script>
<script src="{{ asset('frontend/assets/js/slick-animation.min.js') }}"></script>

<!-- menu js-->
<script src="{{ asset('frontend/assets/js/menu.js') }}"></script>
<script src="{{ asset('frontend/assets/js/sticky-menu.js') }}"></script>

<!-- lazyload js-->
<script src="{{ asset('frontend/assets/js/lazysizes.min.js') }}"></script>

<!-- feather icon js-->
<script src="{{ asset('frontend/assets/js/feather.min.js') }}"></script>

<!-- Bootstrap js-->
<script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>

<!-- Timer js-->
<script src="{{ asset('frontend/assets/js/timer.js') }}"></script>

<!-- Bootstrap Notification js-->
<script src="{{ asset('frontend/assets/js/bootstrap-notify.min.js') }}"></script>

<!-- Theme js-->
{{-- <script src="{{ asset('frontend/assets/js/theme-setting.js') }}"></script> --}}
<script src="{{ asset('frontend/assets/js/script.js') }}"></script>
<script src="{{ asset('frontend/assets/js/custom-slick-animated.js')}}"></script>

{{-- <script src="{{ asset('assets/js/contactMessage.js')}}"></script> --}}
{{-- <script src="{{ asset('assets/js/subscribes.js')}}"></script> --}}
<script src="{{ asset('assets/js/search.js')}}"></script>
{{-- <script src="{{ asset('assets/js/addToCart.js')}}"></script> --}}

<script src="{{asset('AdminAssets/app-assets/vendors/js/extensions/sweetalert2.all.min.js')}}"></script>
@include('frontend.layouts.footer.footer-js')


{!!getSettingValue('footer_codes')!!}
</body>

</html>