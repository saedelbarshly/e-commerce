@extends('frontend.layouts.master')
@section('content')
@include('frontend.layouts.topbar.breadcrumbs')
<!--  dashboard section start -->
<section class="dashboard-section section-b-space user-dashboard-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-3">
        <div class="dashboard-sidebar">
          <div class="profile-top">
            <div class="profile-image">
              <img src="{{ asset($user->photoLink()) }}" alt="" class="img-fluid">
            </div>
            <div class="profile-detail">
              <h5>{{ $user->name }}</h5>
              <h6>{{ $user->email }}</h6>
            </div>
          </div>
          <div class="faq-tab">
            <ul class="nav nav-tabs" id="top-tab" role="tablist">
              <li class="nav-item">
                  <a data-bs-toggle="tab" data-bs-target="#info" class="nav-link active">
                    {{ trans('common.AccountInfo') }}
                  </a>
              </li>
              <li class="nav-item">
                <a data-bs-toggle="tab" data-bs-target="#profile" class="nav-link">{{ trans('common.profile') }}
                </a>
              </li>
              <li class="nav-item"><a data-bs-toggle="tab" data-bs-target="#address" class="nav-link">{{ trans('common.AddressBook') }}</a>
              </li>
              <li class="nav-item"><a data-bs-toggle="tab" data-bs-target="#orders" class="nav-link">{{ trans('common.MyOrders') }}</a></li>
              <li class="nav-item"><a data-bs-toggle="tab" data-bs-target="#wishlist" class="nav-link">{{ trans('common.MyWishlist') }}</a>
              </li>

              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-9">
        <div class="faq-content tab-content" id="top-tabContent">
          <div class="tab-pane fade show active" id="info">
            @include('frontend.profile.includes.info')
          </div>
          <div class="tab-pane fade" id="address">
           @include('frontend.profile.includes.address')
          </div>
          <div class="tab-pane fade" id="orders">
                       @include('frontend.profile.includes.orders')
          </div>
          <div class="tab-pane fade" id="wishlist">
            @include('frontend.profile.includes.wishlist')
          </div>
          <div class="tab-pane fade" id="payment">
            <div class="row">
              <div class="col-12">
                <div class="card mt-0">
                  <div class="card-body">
                    <div class="top-sec">
                      <h3>Saved Cards</h3>
                      <a href="#" class="btn btn-sm btn-solid">+ add new</a>
                    </div>
                    <div class="address-book-section">
                      <div class="row g-4">
                        <div class="select-box active col-xl-4 col-md-6">
                          <div class="address-box">
                            <div class="bank-logo">
                              <img src="../assets/images/bank-logo.png" class="bank-logo">
                              <img src="../assets/images/visa.png" class="network-logo">
                            </div>
                            <div class="card-number">
                              <h6>Card Number</h6>
                              <h5>6262 6126 2112 1515</h5>
                            </div>
                            <div class="name-validity">
                              <div class="left">
                                <h6>name on card</h6>
                                <h5>Mark Jecno</h5>
                              </div>
                              <div class="right">
                                <h6>validity</h6>
                                <h5>XX/XX</h5>
                              </div>
                            </div>
                            <div class="bottom">
                              <a href="javascript:void(0)" data-bs-target="#edit-address" data-bs-toggle="modal"
                                class="bottom_btn">edit</a>
                              <a href="#" class="bottom_btn">remove</a>
                            </div>
                          </div>
                        </div>
                        <div class="select-box col-xl-4 col-md-6">
                          <div class="address-box">
                            <div class="bank-logo">
                              <img src="../assets/images/bank-logo1.png" class="bank-logo">
                              <img src="../assets/images/visa.png" class="network-logo">
                            </div>
                            <div class="card-number">
                              <h6>Card Number</h6>
                              <h5>6262 6126 2112 1515</h5>
                            </div>
                            <div class="name-validity">
                              <div class="left">
                                <h6>name on card</h6>
                                <h5>Mark Jecno</h5>
                              </div>
                              <div class="right">
                                <h6>validity</h6>
                                <h5>XX/XX</h5>
                              </div>
                            </div>
                            <div class="bottom">
                              <a href="javascript:void(0)" data-bs-target="#edit-address" data-bs-toggle="modal"
                                class="bottom_btn">edit</a>
                              <a href="#" class="bottom_btn">remove</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="tab-pane fade" id="profile">
            @include('frontend.profile.includes.profile')
          </div>
          <div class="tab-pane fade" id="security">
            <div class="row">
              <div class="col-12">
                <div class="card mt-0">
                  <div class="card-body">
                    <div class="dashboard-box">
                      <div class="dashboard-title">
                        <h4>settings</h4>
                      </div>
                      <div class="dashboard-detail">
                        <div class="account-setting">
                          <h5>Notifications</h5>
                          <div class="row">
                            <div class="col">
                              <div class="form-check">
                                <input class="radio_animated form-check-input" type="radio" name="exampleRadios"
                                  id="exampleRadios1" value="option1" checked>
                                <label class="form-check-label" for="exampleRadios1">
                                  Allow Desktop Notifications
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="radio_animated form-check-input" type="radio" name="exampleRadios"
                                  id="exampleRadios2" value="option2">
                                <label class="form-check-label" for="exampleRadios2">
                                  Enable Notifications
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="radio_animated form-check-input" type="radio" name="exampleRadios"
                                  id="exampleRadios3" value="option3">
                                <label class="form-check-label" for="exampleRadios3">
                                  Get notification for my own activity
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="radio_animated form-check-input" type="radio" name="exampleRadios"
                                  id="exampleRadios4" value="option4">
                                <label class="form-check-label" for="exampleRadios4">
                                  DND
                                </label>
                              </div>
                            </div>
                          </div>
                        </div>
                        <div class="account-setting">
                          <h5>deactivate account</h5>
                          <div class="row">
                            <div class="col">
                              <div class="form-check">
                                <input class="radio_animated form-check-input" type="radio" name="exampleRadios1"
                                  id="exampleRadios4" value="option4" checked>
                                <label class="form-check-label" for="exampleRadios4">
                                  I have a privacy concern
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="radio_animated form-check-input" type="radio" name="exampleRadios1"
                                  id="exampleRadios5" value="option5">
                                <label class="form-check-label" for="exampleRadios5">
                                  This is temporary
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="radio_animated form-check-input" type="radio" name="exampleRadios1"
                                  id="exampleRadios6" value="option6">
                                <label class="form-check-label" for="exampleRadios6">
                                  other
                                </label>
                              </div>
                              <button type="button" class="btn btn-solid btn-xs">Deactivate
                                Account</button>
                            </div>
                          </div>
                        </div>
                        <div class="account-setting">
                          <h5>Delete account</h5>
                          <div class="row">
                            <div class="col">
                              <div class="form-check">
                                <input class="radio_animated form-check-input" type="radio" name="exampleRadios3"
                                  id="exampleRadios7" value="option7" checked>
                                <label class="form-check-label" for="exampleRadios7">
                                  No longer usable
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="radio_animated form-check-input" type="radio" name="exampleRadios3"
                                  id="exampleRadios8" value="option8">
                                <label class="form-check-label" for="exampleRadios8">
                                  Want to switch on other account
                                </label>
                              </div>
                              <div class="form-check">
                                <input class="radio_animated form-check-input" type="radio" name="exampleRadios3"
                                  id="exampleRadios9" value="option9">
                                <label class="form-check-label" for="exampleRadios9">
                                  other
                                </label>
                              </div>
                              <button type="button" class="btn btn-solid btn-xs">Delete Account</button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--  dashboard section end -->



@stop
