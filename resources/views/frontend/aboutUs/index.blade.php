@extends('frontend.layouts.master')
@section('content')
@include('frontend.layouts.topbar.breadcrumbs')
<!-- about section start -->
<section class="about-page section-b-space">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="banner-section">
          <img src="{{ getSettingImageLink('aboutUsLogo') }}" class="img-responsive img-fluid blur-up lazyload" alt="" width="100%">
        </div>
      </div>
      <div class="col-sm-12">
        <h4>
          {{ getSettingValue('aboutUsTitle_'.$lang) }}
        </h4>
        <p>
          {!! getSettingValue('aboutUsDescription_'.$lang) !!}
        </p>
      </div>
    </div>
  </div>
</section>
<!-- about section end -->

@stop
<style>
  .banner-section {
    height: 500px;
  }

  @media screen and (max-width : 600px) {
    .banner-section {
      height: 180px;
    }
  }
</style>