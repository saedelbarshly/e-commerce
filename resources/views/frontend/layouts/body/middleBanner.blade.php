<!-- Parallax banner -->
<section class="p-0">
  <div class="full-banner text-end p-right " style="padding-top: 80px; padding-bottom: 80px;">
    <img src="{{ (getSettingImageLink('middleBannerImage') == '') ?
      asset('frontend/assets/images/parallax/28.jpg') : getSettingImageLink('middleBannerImage')}}"
      alt="" class="blur-up lazyload w-100">
    {{-- <div class="container">
      <div class="row">
        <div class="col">
          <div class="banner-contain">
            <h2>sale</h2>
            <h3>gaming trends</h3>
            <h4>special offer</h4>
          </div>
        </div>
      </div>
    </div> --}}
  </div>
</section>
<!-- Parallax banner end -->
