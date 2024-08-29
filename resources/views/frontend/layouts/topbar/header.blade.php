{{-- <header class="header-style-5 border-style">
  @include('frontend.layouts.topbar.topHeader')
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="main-menu">
          <div class="menu-left">
            <div class="navbar d-block d-xl-none">
              <a href="javascript:void(0)" id="toggle-sidebar-res">
                <div class="bar-style"><i class="fa fa-bars sidebar-bar" aria-hidden="true"></i>
                </div>
              </a>
            </div>
            <div class="brand-logo">
              <a href="{{ route('e-commerce.index') }}">
                <?php /*<img src="{{ getSettingImageLink('logo') }}" class="img-fluid blur-up lazyload" style="width: 140px;" alt="">*/ ?>
                <img src="{{ getSettingImageLink('logo') }}" height= "80" alt="">
              </a>
            </div>
          </div>
          <div>
           <div class="form_search">
            <input type="text" placeholder="{{ trans('common.SearchAnythingHere') }}"
              class="nav-search nav-search-field" aria-expanded="true" id="input_search1">
            <ul id="search-results1">
            </ul>
          </div>
          </div>
          <div class="menu-right pull-right">
            <div>
              <div class="icon-nav d-none d-sm-block">
                <ul>
                  <li class="onhover-div mobile-search d-xl-none d-inline-block">
                    <div>
                      <img src="{{ asset('frontend/assets/images/icon/search.png') }}"
                        class="img-fluid blur-up lazyload" alt="">
                      <i class="ti-search"></i>
                    </div>
                  </li>
                  <li class="onhover-div mobile-setting">
                    <div>
                      <img src="{{ asset('frontend/assets/images/icon/setting.png') }}"
                        class="img-fluid blur-up lazyload" alt="">
                      <i class="ti-settings"></i>
                    </div>
                  </li>
                  <li class="onhover-div mobile-cart">
                    <div>
                      <img src="{{ asset('frontend/assets/images/icon/cart.png') }}" class="img-fluid blur-up lazyload"
                        alt="">
                      <i class="ti-shopping-cart"></i>
                    </div>
                    <span class="cart_qty_cls">2</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header> --}}
   <header >
      <div class="spinnerContainer " >
     <div class="spinner">
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
      <div></div>
    </div>
</div>
<style>
  .spinnerContainer{position: fixed;top: 0;left: 0;display:flex;justify-content: center;align-items: center;width: 100vw;height: 100vh;z-index: 999999;}.spinner {position: absolute;width: 9px; height: 9px;}.spinner div {position: absolute;width: 50%;height: 150%;background: #C1AA72;transform: rotate(calc(var(--rotation) * 1deg)) translate(0, calc(var(--translation) * 1%));animation: spinner-fzua35 1s calc(var(--delay) * 1s) infinite ease;}.spinner div:nth-child(1) {--delay: 0.1;--rotation: 36;--translation: 150; }.spinner div:nth-child(2) {--delay: 0.2;--rotation: 72;--translation: 150;}.spinner div:nth-child(3) {--delay: 0.3;--rotation: 108;--translation: 150;}.spinner div:nth-child(4) {--delay: 0.4;--rotation: 144;--translation: 150;}.spinner div:nth-child(5) {--delay: 0.5;--rotation: 180;--translation: 150;}.spinner div:nth-child(6) {--delay: 0.6;--rotation: 216;--translation: 150;}.spinner div:nth-child(7) {--delay: 0.7;--rotation: 252;--translation: 150;}.spinner div:nth-child(8) {--delay: 0.8;--rotation: 288;--translation: 150;}.spinner div:nth-child(9) {--delay: 0.9;--rotation: 324;--translation: 150;}.spinner div:nth-child(10) {--delay: 1;--rotation: 360;--translation: 150;}
  @keyframes spinner-fzua35 {
    0%, 10%, 20%, 30%, 50%, 60%, 70%, 80%, 90%, 100% {
        transform: rotate(calc(var(--rotation) * 1deg)) translate(0, calc(var(--translation) * 1%));
    }
    50% {
        transform: rotate(calc(var(--rotation) * 1deg)) translate(0, calc(var(--translation) * 1.5%));
    }
  }
</style>
<div class="container">
  <section class="small-section pb-0 pt-res-0 small-slider">
    <div class="home-slider">
      <div class="home"></div>
    </div>
  </section>
</div>
<section class="banner-goggles banner-padding ratio2_1">
  <div class="container">
    <div class="row partition3">
      <div class="col-md-4">
        <a href="#">
          <div class="collection-banner">
            <div class="ldr-bg">
              <div class="contain-banner banner-3">
                <div>
                  <h4></h4>
                  <h2></h2>
                  <h6></h6>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-md-4">
        <a href="#">
          <div class="collection-banner">
            <div class="ldr-bg">
              <div class="contain-banner banner-3">
                <div>
                  <h4></h4>
                  <h2></h2>
                  <h6></h6>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
      <div class="col-md-4">
        <a href="#">
          <div class="collection-banner">
            <div class="ldr-bg">
              <div class="contain-banner banner-3">
                <div>
                  <h4></h4>
                  <h2></h2>
                  <h6></h6>
                </div>
              </div>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>
</div>
<!-- loader end -->


<!-- header start -->
<header class="header-style-5 border-style" id="sticky-header">
  @include('frontend.layouts.topbar.topHeader')
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <div class="main-menu">
          <div class="menu-left">
            <div class="navbar d-block d-xl-none">
              <a href="javascript:void(0)" id="toggle-sidebar-res">
                <div class="bar-style">
                  <i class="fa fa-bars sidebar-bar" aria-hidden="true"></i>
                </div>
              </a>
            </div>
           <div class="brand-logo">
              <a href="{{ route('e-commerce.index') }}">
                <?php /*<img src="{{ getSettingImageLink('logo') }}" class="img-fluid blur-up lazyload" style="width: 140px;" alt="">*/ ?>
                <img src="{{ getSettingImageLink('logo') }}" height= "80" alt="">
              </a>
            </div>
          </div>
          <div>
            <div class="form_search ajax-search the-basics" role="form">
              <div class="search-container">
                <input type="text" placeholder="{{ trans('common.SearchAnythingHere') }}" class="nav-search nav-search-field" aria-expanded="true" id="input_search" >
              </div>
              <div class="col-sm-12" style="position: absolute;top: 100%;left: 0px;z-index: 100;background-color: floralwhite;display: none;height: 300px;overflow-y: scroll;" id="searchDiv">
                <div class="tt-dataset tt-dataset-states" id="search-results">

                </div>
              </div>
            </div>
          </div>
          <div class="menu-right pull-right">
            <div>
              <div class="icon-nav">
                <ul>
                  <li class="onhover-div mobile-search d-xl-none d-inline-block">
                    <div><img src="{{ asset('frontend/assets/images/icon/search.png') }}" onclick="openSearch()"
                        class="img-fluid blur-up lazyload" alt=""> <i class="ti-search" onclick="openSearch()"></i>
                    </div>
                  </li>
                  @include('frontend.layouts.topbar.lang')
                  @include('frontend.layouts.topbar.cart')
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

      </ul>
    </div>
  </div>
  <div class="bottom-part bottom-light">
    <div class="container">
      <div class="row">
        <div class="col-xl-9" id="main-nav-center">
          <div class="main-nav-center">
            @include('frontend.layouts.topbar.nav')
          </div>
        </div>
        <div class="col-xl-3 d-xl-block d-none">
          <div class="header-options">
            <div class="vertical-slider no-arrow">
              <div>
                <span>
                  <i class="{{ getSettingValue('notificationIcon') }}" aria-hidden="true">
                    {{-- <img src="{{ getSettingImageLink('notificationIcon') }}" class="img-fluid lazyload" alt="">
                    --}}
                  </i>{{ getSettingValue('mainPageNotification1_'.$lang) }}
                </span>
              </div>
              <div>
                <span>
                  <i class="{{ getSettingValue('notificationIcon') }}" aria-hidden="true"></i>
                  {{ getSettingValue('mainPageNotification2_'.$lang) }}
                </span>
              </div>
              <div>
                <span>
                  <i class="{{ getSettingValue('notificationIcon') }}" aria-hidden="true"></i>
                  {{ getSettingValue('mainPageNotification3_'.$lang) }}
                </span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</header>
<!-- header end -->
