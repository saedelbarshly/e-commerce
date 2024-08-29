<?php
$rightFooter = App\Models\Menu::with('items')->where('place', 'footer2')->get();
$leftFooter = App\Models\Menu::with('items')->where('place', 'footer1')->get();
?>

<section class="section-b-space darken-layout">
  <div class="container">
    <div class="m-0 p-0 row justify-content-center align-items-center footer-theme partition-f">
      <div class="m-0 p-0 col-12 col-md-6 col-lg-3 mb-3 mb-lg-0 sub-title">

        <div class="footer-logo"><img src="{{ getSettingImageLink('logo') }}" alt="" class="img-fluid" style="width: 140px;">
        </div>
        <p>
          {{ getSettingValue('siteDescription_'.$lang) }}
        </p>
        <ul class="contact-list">
          <li class="d-block mb-2">
            <i class="fa fa-map-marker"></i>
            {{ getSettingValue('address_'.$lang) }}
          </li>
          <li class="d-block mb-2">
            <i class="fa fa-phone"></i>{{ trans('common.callUs') . ' : ' . getSettingValue('phone') }}
          </li>
          <li class="d-block mb-2">
            <i class="fa fa-envelope"></i>
            {{ trans('common.email') }} : <a href="#">{{ getSettingValue('email') }}</a>
          </li>
        </ul>

      </div>
      <div class="m-0 p-0 col-12 col-md-6 col-lg-3 mb-3 mb-lg-0">
        @foreach ($rightFooter as $rFooter)
        <div class="sub-title">
          <div class="footer-title">
            <h4 class="mb-1">
              {{ $rFooter['title_'.$lang] }}
            </h4>
          </div>
          <div class="footer-contant my-2">
            <ul>
              @foreach ($rFooter->items as $item)
              <li>
                <a href="
                  {{ $item->itemRoute() }}
                ">
                  {{ $item['title_'.$lang] }}
                </a>
              </li>
              @endforeach
            </ul>
          </div>
        </div>
        @endforeach
      </div>
      <div class="m-0 p-0 col-12 col-md-6 col-lg-3 mb-3 mb-lg-0">
        @foreach ($leftFooter as $lFooter)
        <div class="sub-title">
          <div class="footer-title">
            <h4 class="mb-1">
              {{ $lFooter['title_'.$lang] }}
            </h4>
          </div>

          <div class="footer-contant">
            <ul>
              @foreach ($lFooter->items as $item)
              <li><a href="{{ $item->itemRoute() }}">
                  {{ $item['title_'.$lang] }}
                </a></li>
              @endforeach
            </ul>
          </div>

        </div>
        @endforeach
      </div>
      <div class="m-0 p-0 col-12 col-md-6 col-lg-3 mb-3 mb-lg-0">
        <div class="sub-title">
          <div class="footer-contant">
            {{-- {!! NoCaptcha::renderJs() !!} --}}
            @if ($errors->has('g-recaptcha-response'))
            <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
            @endif
            <div class="my-2" style="color: white">{{ trans('common.getAllNews') }}</div>
            <form class="form-inline" method="POST" action="{{ route('subscribes.store') }}" id="subscribeForm">
              @csrf
              {{-- {!! NoCaptcha::display() !!} --}}
              <div class="form-group me-sm-3 mb-2">
                <input type="email" class="form-control -bottom-3" id="email" name="email" placeholder="{{ trans('common.EnterYourEmail') }}" id="email" {{ old('email') }}>
              </div>
              <button type="submit" class="btn btn-solid mb-2">
                {{ trans('common.send') }}
              </button>
              <div><span class="text-danger d-inline-block mt-1 text-error email_error"></span></div>
            </form>


            <div class="footer-social">
              <ul>
                @if(getSettingValue('facebook'))
                <li><a href="{{ getSettingValue('facebook') }}"><i class="fa fa-facebook-f"></i></a></li>
                @endif
                @if(getSettingValue('facebook'))
                <li><a href="{{ getSettingValue('facebook') }}"><i class="fa-brands fa-tiktok"></i></a></li>
                @endif
                @if(getSettingValue('facebook'))
                <li><a href="{{ getSettingValue('facebook') }}"><i class="fa-brands fa-snapchat"></i></a></li>
                @endif
                @if(getSettingValue('youtube'))
                <li><a href="{{ getSettingValue('youtube') }}"><i class="fa fa-youtube"></i></a></li>
                @endif
                @if(getSettingValue('twitter'))
                <li><a href="{{ getSettingValue('twitter') }}"><i class="fa fa-twitter"></i></a></li>
                @endif
                @if(getSettingValue('instagram'))
                <li><a href="{{ getSettingValue('instagram') }}"><i class="fa fa-instagram"></i></a></li>
                @endif
                @if(getSettingValue('tiktok'))
                <li><a href="{{ getSettingValue('tiktok') }}"><i class="fa-brands fa-tiktok"></i></a></li>
                @endif
                @if(getSettingValue('snapchat'))
                <li><a href="{{ getSettingValue('snapchat') }}"><i class="fa fa-snapchat"></i></a></li>
                @endif

              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<style>
  @media screen and (max-width : 767px) {
    .footer-contant {
      display: block !important;
    }
  }
</style>