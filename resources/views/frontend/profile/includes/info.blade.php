<div class="counter-section">
  <div class="welcome-msg">
    <h4>{{ trans('common.hello') }}, {{ $user->name }} !</h4>
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{ session()->get('success') }}!</strong>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
  </div>
  <div class="row">
    <div class="col-md-4">
      <div class="counter-box">
        <img src="{{ asset('frontend/assets/images/icon/dashboard/sale.png') }}" class="img-fluid">
        <div>
          <h3>
            {{ count($user->myOrders) }}
          </h3>
          <h5>{{ trans('common.TotalOrders') }}</h5>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="counter-box">
        <img src="{{ asset('frontend/assets/images/icon/dashboard/homework.png') }}" class="img-fluid">
        <div>
          <h3>
            {{ ($user->myOrders->where('status', 'pending')->count()) }}
          </h3>
          <h5>{{ trans('common.PendingOrders') }}</h5>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="counter-box">
        <img src="{{ asset('frontend/assets/images/icon/dashboard/order.png') }}" class="img-fluid">
        <div>
          <h3>
            {{ count($user->wishlist) }}
          </h3>
          <h5>{{ trans('common.MyWishlist') }}</h5>
        </div>
      </div>
    </div>
  </div>
  <div class="box-account box-info">
    <div class="box-head">
      <h4>{{ trans('common.AccountInformation') }}</h4>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <div class="box">
          <div class="box-title">
            <h3>{{ trans('common.ContactInformation') }}</h3>
            <a href="{{ route('profile.edit') }}">{{ trans('common.edit') }}</a>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="box">
          <div class="box-title">
            <h3>{{ trans('common.ChangePassword') }}</h3>
            <a href="{{ route('profile.editPassword') }}">
              {{ trans('common.edit') }}
            </a>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
