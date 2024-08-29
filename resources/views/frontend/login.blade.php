@extends('frontend.layouts.master')
@section('content')
  @include('frontend.layouts.topbar.breadcrumbs')
  <!--section start-->
  <section class="login-page section-b-space">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <h3>{{ $title }}</h3>
          <div class="theme-card">
            @if(session()->get('faild') != '')
            <div class="alert alert-danger py-2 text-center">
              {{session()->get('faild')}}
            </div>
            @endif
            @if(session()->get('success') != '')
            <div class="alert alert-success py-2 text-center">
              {{session()->get('success')}}
            </div>
            @endif
            <form class="theme-form" method="POST" action="{{ route('login') }}">
              @csrf
              <div class="form-group">
                <label for="email">{{ trans('common.email') }}</label>
                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="{{ trans('common.EnterYourEmail') }}"
                aria-describedby="login-email" tabindex="1" autofocus value="{{ old('email') }}" required >
                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="form-group">
                <label for="review">{{ trans('common.password') }}</label>
                <input type="password" class="form-control" id="review" name="password" placeholder="{{ trans('common.EnterYourPassword') }}" required>
                @error('password')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <input type="submit" class="btn btn-solid" value="{{ trans('common.login') }}">
            </form>
          </div>
        </div>
        <div class="col-lg-6 right-login">
          <h3>{{ trans('common.newCustomer') }}</h3>
          <div class="theme-card authentication-right">
            <h6 class="title-font">{{ trans('common.createAnAccount') }}</h6>
            <p>
              {{ trans('common.quickRegister') }}
            </p>
              <a href="{{ route('user.register') }}" class="btn btn-solid">
                {{ trans('common.createAnAccount') }}
              </a>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--Section ends-->
@stop
