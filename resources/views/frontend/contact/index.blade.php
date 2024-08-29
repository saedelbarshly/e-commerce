@extends('frontend.layouts.master')
@section('content')
@include('frontend.layouts.topbar.breadcrumbs')
<!--section start-->
<section class="contact-page section-b-space">
  <div class="container">
    <div class="row section-b-space">
      <div class="col-lg-7 map">
        {!! getSettingValue('map') !!}
      </div>
      <div class="col-lg-5">
        <div class="contact-right">
          <ul>
            <li>
              <div class="contact-icon">
                <i class="fa-solid fa-phone myPhone"></i>
                <h6>{{ trans('common.contactUs') }}</h6>
              </div>
              <div class="media-body">
                <p>{{ getSettingValue('phone') }}</p>
                <p>{{ getSettingValue('mobile') }}</p>
              </div>
            </li>
            <li>
              <div class="contact-icon"><i class="fa fa-map-marker" aria-hidden="true"></i>
                <h6>{{ trans('common.address') }}</h6>
              </div>
              <div class="media-body">
                <p>{{ getSettingValue('address_'.$lang) }}</p>
              </div>
            </li>
            <li>
              <div class="contact-icon">
                <i class="fa-solid fa-envelope myPhone"></i>
                <h6>{{ trans('common.email') }}</h6>
              </div>
              <div class="media-body">
                <p>{{ getSettingValue('email') }}</p>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <form class="theme-form" method="POST" action="{{ route('message.store') }}" id="Message_Form">
          @csrf
          @method('POST')
          <div class="form-row row">
            <div class="col-md-6">
              <label for="name">{{ trans('common.name') }}</label>
              <span class="validity text-danger">*</span>
              <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="{{ trans('common.EnterYourName') }}" required>
              @error('name')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-md-6">
              <label for="email">{{ trans('common.email') }}</label>
              <span class="validity text-danger">*</span>
              <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="{{ trans('common.EnterYourEmail') }}" required>
              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-md-6">
              <label for="phone">{{ trans('common.phone') }}</label>
              <span class="validity text-danger">*</span>
              <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" placeholder="{{ trans('common.phone') }}" required>
              @error('phone')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-md-6">
              <label for="address">{{ trans('common.address') }}</label>
              <span class="validity text-danger">*</span>
              <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" placeholder="{{ trans('common.EnterYourAddress') }}" required>
              @error('address')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-md-12">
              <label for="content">{{ trans('common.EnterYourMessage') }}</label>
              <span class="validity text-danger">*</span>
              <textarea class="form-control @error('content') is-invalid @enderror" placeholder="{{ trans('common.EnterYourMessage') }}" id="content" name="content" rows="4"></textarea>
              @error('content')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-md-12">
              <input type="submit" class="btn btn-solid" value="{{ trans('common.SendYourMessage') }}">
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
<!--Section ends-->
@stop