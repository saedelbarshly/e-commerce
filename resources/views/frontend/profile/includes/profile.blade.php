<div class="row">
  <div class="col-12">
    <div class="card mt-0">
      <div class="card-body">
        <div class="dashboard-box">
          <div class="dashboard-title">
            <h4>{{ trans('common.profile') }}</h4>
            <a class="edit-link" href="{{ route('profile.edit') }}">{{ trans('common.edit') }}</a>
          </div>
          <div class="dashboard-detail">
            <ul>
              <li>
                <div class="details">
                  <div class="left">
                    <h6>{{ trans('common.name') }}</h6>
                  </div>
                  <div class="right">
                    <h6>{{ $user->name }}</h6>
                  </div>
                </div>
              </li>
              <li>
                <div class="details">
                  <div class="left">
                    <h6>{{ trans('common.email') }}</h6>
                  </div>
                  <div class="right">
                    <h6>{{ $user->email }}</h6>
                  </div>
                </div>
              </li>
              <li>
                <div class="details">
                  <div class="left">
                    <h6>{{ trans('common.country') }}</h6>
                  </div>
                  <div class="right">
                    <h6>{{ $user->countryData() }}</h6>
                  </div>
                </div>
              </li>
              <li>
                <div class="details">
                  <div class="left">
                    <h6>{{ trans('common.city') }}</h6>
                  </div>
                  <div class="right">
                    <h6>{{ $user->city }}</h6>
                  </div>
                </div>
              </li>
              <li>
                <div class="details">
                  <div class="left">
                    <h6>{{ trans('common.address') }}</h6>
                  </div>
                  <div class="right">
                    <h6>{{ $user->address }}</h6>
                  </div>
                </div>
              </li>
              <li>
                <div class="details">
                  <div class="left">
                    <h6>{{ trans('common.YearRegistration') }}</h6>
                  </div>
                  <div class="right">
                    <h6>{{ $user->created_at->format('Y M')}}</h6>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <div class="dashboard-title mt-lg-5 mt-3">
            <h4>{{ trans('common.loginDetails') }}</h4>
            <a class="edit-link" href="#">{{ trans('common.edit') }}</a>
          </div>
          <div class="dashboard-detail">
            <ul>
              <li>
                <div class="details">
                  <div class="left">
                    <h6>{{ trans('common.email') }}</h6>
                  </div>
                  <div class="right">
                    <h6>{{ $user->email }} </h6>
                  </div>
                </div>
              </li>
              <li>
                <div class="details">
                  <div class="left">
                    <h6>{{ trans('common.password') }}</h6>
                  </div>
                  <div class="right">
                    <h6>*******
                    </h6>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
