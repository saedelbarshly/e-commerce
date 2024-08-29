@extends('frontend.layouts.master')
@section('content')
@include('frontend.layouts.topbar.breadcrumbs')
<!-- personal deatail section start -->
<section class="contact-page register-page mb-5">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h3>{{ trans('common.ChangePassword') }}</h3>
        <form class="theme-form mb-5" method="POST" action="{{ route('profile.updatePassword') }}"
          enctype="multipart/form-data">
          @csrf
          <div class="form-row row">
            <div class="col-md-6">
              <label for="password">{{ trans('common.password') }}</label>
              <span class="validity text-danger">*</span>
              <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                placeholder="{{ trans('common.EnterYourPassword') }}" required>
              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="col-md-6">
              <label for="password_confirmation">{{ trans('common.password_confirmation') }}</label>
              <span class="validity text-danger">*</span>
              <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"
                name="password_confirmation" placeholder="{{ trans('common.password_confirmation') }}" required>
              @error('password_confirmation')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="col-md-12">
              <button class="btn btn-sm btn-solid" type="submit">{{ trans('common.Save Changes') }}</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>

@stop
