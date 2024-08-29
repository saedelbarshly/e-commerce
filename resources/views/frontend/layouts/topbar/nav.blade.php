<?php
  $header_menu = App\Models\Menu::where('place', 'header')->first();
?>
<nav id="main-nav" class="text-start">
  <div class="toggle-nav mt-4">
    {{-- <i class="fa fa-bars sidebar-bar"></i> --}}
  </div>
  <ul id="main-menu" class="sm pixelstrap sm-horizontal">
    <li>
      <div class="mobile-back text-end">
        <img style="margin-inline-end: auto;" height="40" src="{{ getSettingImageLink('logo') }}" alt="">
        <i class="fa-solid fa-xmark ps-2" aria-hidden="true"></i>
      </div>
    </li>
    <li><a href="{{ route('e-commerce.index') }}">{{ trans('common.home') }}</a></li>
    <li><a href="{{ route('e-commerce.products') }}">{{ trans('common.products') }}</a></li>
    <li><a href="{{ route('e-commerce.faqs') }}">{{ trans('common.FAQs') }}</a></li>
    <li><a href="{{ route('e-commerce.contact') }}">{{ trans('common.contactUs') }}</a></li>
    <li><a href="{{ route('e-commerce.about') }}">{{ trans('common.aboutUs') }}</a></li>
    @foreach ($header_menu->items as $item)
      @if ($item->mainElement == 0)
        <li>
          @if ($item->subItems()->count() == 0)
            <a href="{{ $item->itemRoute() }}">{{ $item['title_'.$lang] }}</a>
          @else
            <a href="#">{{ $item['title_'.$lang] }}</a>
            <ul>
              @foreach ($item->subItems as $subItem)
                <li>
                  <a href="{{ $subItem->itemRoute() }}">{{ $subItem['title_'.$lang] }}</a>
                </li>
              @endforeach
            </ul>
          @endif
        </li>
      @endif
    @endforeach

    @foreach(panelLangMenu()['list'] as $singleLang)
      <li class="d-block d-sm-none">
        <a class="dropdown-item" href="{{url('/SwitchLang/'.$singleLang['lang'])}}" data-language="{{$singleLang['lang']}}">
          <i class="flag-icon flag-icon-{{$singleLang['flag']}}"></i> {{trans('common.'.$singleLang['text'])}}
        </a>
      </li>
    @endforeach
    {{-- <li>
      <div class="mobile-back text-end">Back<i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
    </li>

    <li>
      <a href="#">{{ $navItems }}</a>
    </li>
    @foreach ($navItems as $item)
    <li>
      <a href="#">{{ $item['title_'.$lang] }}</a>
      <ul>
      @foreach ($item->items as $element)
        <li>
          <a href="{{ $element->itemRoute() }}">{{ $element['title_'.$lang] }}</a>
        </li>
        @endforeach
      </ul>
    </li>
    @endforeach
    <li>
      <a href="#">{{ trans('common.pages') }}</a>
      <ul>
        <li>
          <a href="{{ route('e-commerce.polices') }}">{{ trans('common.policesPrivacies') }}</a>
        </li>
        <li>
          <a href="#">vendor</a>
          <ul>
            <li><a href="vendor-dashboard.html">vendor dashboard</a>
            </li>
            <li><a href="vendor-profile.html">vendor profile</a></li>
            <li><a href="become-vendor.html">become vendor</a></li>
          </ul>
        </li>
        <li>
          <a href="#">account</a>
          <ul>
            <li><a href="{{ route('e-commerce.wishlist') }}">wishlist</a></li>
            <li><a href="{{ route('e-commerce.cart') }}">cart</a></li>
            <li><a href="dashboard.html">Dashboard</a></li>
            <li><a href="{{  route('user.login') }}">login</a></li>
            <li><a href="{{ route('user.register') }}">register</a></li>
            <li><a href="forget_pwd.html">forget password</a></li>
            <li><a href="{{ route('e-commerce.profile') }}">profile</a></li>
            <li><a href="checkout.html">checkout</a></li>
            <li><a href="order-success.html">order success</a></li>
            <li><a href="order-tracking.html">order tracking<span class="new-tag">new</span></a></li>
          </ul>
        </li>
        <li>
          <a href="#">portfolio</a>
          <ul>
            <li><a href="">grid</a>
              <ul>
                <li><a href="grid-2-col.html">grid
                    2</a></li>
                <li><a href="grid-3-col.html">grid
                    3</a></li>
                <li><a href="grid-4-col.html">grid
                    4</a></li>
              </ul>
            </li>
            <li><a href="">masonry</a>
              <ul>
                <li><a href="masonary-2-grid.html">grid 2</a></li>
                <li><a href="masonary-3-grid.html">grid 3</a></li>
                <li><a href="masonary-4-grid.html">grid 4</a></li>
                <li><a href="masonary-fullwidth.html">full width</a>
                </li>
              </ul>
            </li>
          </ul>
        </li>
        <li><a href="search.html">search</a></li>
        <li><a href="review.html">review</a>
        </li>
        <li>
          <a href="#">compare</a>
          <ul>
            <li><a href="compare.html">compare</a></li>
            <li><a href="compare-2.html">compare-2</a></li>
          </ul>
        </li>
        <li><a href="collection.html">collection</a></li>
        <li><a href="lookbook.html">lookbook</a></li>
        <li><a href="sitemap.html">site map</a>
        </li>
        <li><a href="{{ route('e-commerce.error') }}">404</a></li>
        <li><a href="coming-soon.html">coming soon</a></li>
      </ul>
    </li>
    <li>
      <a href="{{ route('e-commerce.blog') }}">{{ trans('common.blog') }}</a>
    </li> --}}
  </ul>
</nav>
