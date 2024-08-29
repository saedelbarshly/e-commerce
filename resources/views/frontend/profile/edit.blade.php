@extends('frontend.layouts.master')
@section('content')
  @include('frontend.layouts.topbar.breadcrumbs')
  <!-- personal deatail section start -->
  <section class="contact-page register-page mb-5">
    <div class="container">
      <div class="row">
        <div class="col-sm-12">
          <h3>{{ trans('common.personalDetail') }}</h3>
          <form class="theme-form mb-5" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-row row">
              <div class="col-md-6">
                <label for="name">{{ trans('common.name') }}</label>
                <span class="validity text-danger">*</span>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                  placeholder="{{ trans('common.EnterYourName') }}" value="{{ $user->name }}" required>
                @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="userName">{{ trans('common.username') }}</label>
                <span class="validity text-danger">*</span>
                <input type="text" class="form-control @error('userName') is-invalid @enderror" id="userName" name="userName"
                  placeholder="{{ trans('common.EnterUserName') }}" value="{{ $user->userName }}" required>
                @error('userName')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="email">{{ trans('common.email') }}</label>
                <span class="validity text-danger">*</span>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                  placeholder="{{ trans('common.EnterYourEmail') }}" value="{{ $user->email }}" required>
                @error('email')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="phone">{{ trans('common.phone') }}</label>
                <span class="validity text-danger">*</span>
                <input type="phone" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone"
                  placeholder="{{ trans('common.EnterYourPhone') }}" value="{{ $user->phone }}" required>
                @error('phone')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <div class="col-md-6 select_input">
                <label for="country">{{ trans('common.country') }}</label>
                <span class="validity text-danger">*</span>
                <select class="form-control"  name="country">
                  <option disabled selected>--{{ trans('common.selectYourCountry') }}--</option>
                  @foreach ($countries as $key => $country)
                  <option value="{{ $key }}" @selected($user->country == $key) >{{ $country }}</option>
                  @endforeach
                </select>
                @error('country')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                <label for="city">{{ trans('common.city') }}</label>
                <span class="validity text-danger">*</span>
                <input type="text" class="form-control" name="city" value="{{ $user->city }}" placeholder="{{ trans('common.city') }}"
                  id="city" class="@error('city') is-invalid @enderror">
                @error('city')
                <span class="text-danger">{{ $message }}</span>
                @enderror
              </div>
              <div class="col-md-6">
                  <label for="address">{{ trans('common.address') }}</label>
                  <span class="validity text-danger">*</span>
                  <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address"
                    placeholder="{{ trans('common.EnterYourAddress') }}" value="{{ $user->address }}" required>
                  @error('address')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
              </div>
              <div class="col-md-6">
                  <label for="photo">{{ trans('common.photo') }}</label>
                  <span class="validity text-danger">*</span>
                  <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo" name="photo" >
                  @error('photo')
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
