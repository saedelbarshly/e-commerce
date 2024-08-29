<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header" style="display: flex; justify-content: center; align-items: center;">
        <ul class="nav navbar-nav flex-row mb-2" style="display: flex;justify-content: center; padding-top: 25px;">
            <img src="{{asset('AdminAssets/app-assets/images/logo/logo.png')}}" width="80%" class="img-responsive" style="max-width: 100%;max-height: 100%;"/>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="@if(isset($active) && $active == 'panelHome') active @endif nav-item" >
                <a class="d-flex align-items-center" href="{{route('admin.index')}}">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.PanelHome')}}">
                        {{trans('common.PanelHome')}}
                    </span>
                </a>
            </li>
            <li class=" nav-item">
              <a class="d-flex align-items-center" href="#">
                <i data-feather="settings"></i>
                <span class="menu-title text-truncate" data-i18n="{{trans('common.control')}}">
                  {{trans('common.control')}}
                </span>
              </a>
              <ul class="menu-content">
                <li class="nav-item @if(isset($active) && $active == 'setting') active @endif">
                  <a class="d-flex align-items-center" href="{{route('admin.settings.general')}}">
                    <i data-feather='circle'></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.setting')}}">
                      {{trans('common.setting')}}
                    </span>
                  </a>
                </li>
                <li class="nav-item @if(isset($active) && $active == 'menus') active @endif">
                  <a class="d-flex align-items-center" href="{{route('admin.menus')}}">
                    <i data-feather='circle'></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.menus')}}">
                      {{trans('common.menus')}}
                    </span>
                  </a>
                </li>
                <li @if(isset($active) && $active=='currencies' ) class="active" @endif>
                  <a class="d-flex align-items-center" href="{{route('admin.currencies')}}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="{{trans('common.currencies')}}">
                      {{trans('common.currencies')}}
                    </span>
                  </a>
                </li>
                <li @if(isset($active) && $active=='length' ) class="active" @endif>
                  <a class="d-flex align-items-center" href="{{route('admin.length')}}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="{{trans('common.length')}}">
                      {{trans('common.length')}}
                    </span>
                  </a>
                </li>
                <li @if(isset($active) && $active=='weight' ) class="active" @endif>
                  <a class="d-flex align-items-center" href="{{route('admin.weight')}}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="{{trans('common.weight')}}">
                      {{trans('common.weight')}}
                    </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="d-flex align-items-center" href="#">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="{{trans('common.taxes')}}">
                       الضرائب
                    </span>
                  </a>
                  <ul class="menu-content">
                    <li @if(isset($active) && $active=='taxTypes' ) class="active" @endif>
                      <a class="d-flex align-items-center" href="{{route('admin.taxTypes')}}">
                        <i data-feather="arrow-left-circle"></i>
                        <span class="menu-item text-truncate" data-i18n="{{trans('common.taxTypes')}}">
                          فئات الضرائب
                        </span>
                      </a>
                    </li>
                    <li class="nav-item @if(isset($active) && $active == 'taxRates') active @endif">
                      <a class="d-flex align-items-center" href="{{route('admin.taxRates')}}">
                        <i data-feather='arrow-left-circle'></i>
                        <span class="menu-title text-truncate" data-i18n="{{trans('common.taxRates')}}">
                           أسعار الضرائب
                        </span>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </li>

            <li class="nav-item @if(isset($active) && $active == 'pages') active @endif">
                <a class="d-flex align-items-center" href="{{route('admin.pages')}}">
                    <i data-feather='columns'></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.pages')}}">
                        {{trans('common.pages')}}
                    </span>
                </a>
            </li>
            <li class="nav-item">
              <a class="d-flex align-items-center" href="#">
                <i data-feather="home"></i>
                <span class="menu-title text-truncate" data-i18n="{{trans('common.storefront')}}">
                  واجهه المتجر
                </span>
              </a>
              <ul class="menu-content">
                <li @if(isset($active) && $active=='companies' ) class="active" @endif>
                  <a class="d-flex align-items-center" href="{{route('admin.companies')}}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="{{trans('common.companies')}}">
                      الشركات
                    </span>
                  </a>
                </li>
                <li class="nav-item @if(isset($active) && $active == 'categories') active @endif">
                  <a class="d-flex align-items-center" href="{{route('admin.categories')}}">
                    <i data-feather='circle'></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.categories')}}">
                      الأقسام
                    </span>
                  </a>
                </li>
                <li @if(isset($active) && $active=='products' ) class="active" @endif>
                  <a class="d-flex align-items-center" href="{{ route('admin.products') }}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="{{trans('common.products')}}">
                      المنتجات
                    </span>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="d-flex align-items-center" href="#">
                    <i data-feather="circle"></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.productDescription')}}">
                      موصفات المنتجات
                    </span>
                  </a>
                  <ul class="menu-content">
                    <li @if(isset($active) && $active=='specifications' ) class="active" @endif>
                      <a class="d-flex align-items-center" href="{{route('admin.specifications')}}">
                        <i data-feather="arrow-left-circle"></i>
                        <span class="menu-item text-truncate" data-i18n="{{trans('common.productSpecifications')}}">
                          الموصفات
                        </span>
                      </a>
                    </li>
                    <li class="nav-item @if(isset($active) && $active == 'specificationTypes') active @endif">
                      <a class="d-flex align-items-center" href="{{route('admin.specificationTypes')}}">
                        <i data-feather='arrow-left-circle'></i>
                        <span class="menu-title text-truncate" data-i18n="{{trans('common.specificationTypes')}}">
                          أنواع الموصفات
                        </span>
                      </a>
                    </li>
                  </ul>
                </li>
                <li @if(isset($active) && $active=='options' ) class="active" @endif>
                  <a class="d-flex align-items-center" href="{{ route('admin.options') }}">
                    <i data-feather="circle"></i>
                    <span class="menu-item text-truncate" data-i18n="{{trans('common.productsOptions')}}">
                      خيارات المنتجات
                    </span>
                  </a>
                </li>
              </ul>
            </li>

            <li class=" nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="shield"></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.UsersManagment')}}">
                        {{trans('common.UsersManagment')}}
                    </span>
                </a>
                <ul class="menu-content">
                    <li @if(isset($active) && $active == 'adminUsers') class="active" @endif>
                        <a class="d-flex align-items-center" href="{{route('admin.adminUsers')}}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="{{trans('common.AdminUsers')}}">
                                {{trans('common.AdminUsers')}}
                            </span>
                        </a>
                    </li>
                    <li @if(isset($active) && $active == 'clientUsers') class="active" @endif>
                        <a class="d-flex align-items-center" href="{{route('admin.clientUsers')}}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="{{trans('common.Clients')}}">
                                {{trans('common.Clients')}}
                            </span>
                        </a>
                    </li>
                    <li @if(isset($active) && $active == 'roles') class="active" @endif>
                        <a class="d-flex align-items-center" href="{{route('admin.roles')}}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="{{trans('common.Roles')}}">
                                {{trans('common.Roles')}}
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class=" nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="map-pin"></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.LocalesManagment')}}">
                        {{trans('common.LocalesManagment')}}
                    </span>
                </a>
                <ul class="menu-content">
                    <li @if(isset($active) && $active == 'countries') class="active" @endif>
                        <a class="d-flex align-items-center" href="{{route('admin.countries')}}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="{{trans('common.Countries')}}">
                                {{trans('common.Countries')}}
                            </span>
                        </a>
                    </li>
                    <li @if(isset($active) && $active == 'ShippingLocations') class="active" @endif>
                        <a class="d-flex align-items-center" href="{{route('admin.shippingLocations')}}">
                            <i data-feather="circle"></i>
                            <span class="menu-item text-truncate" data-i18n="{{trans('common.ShippingLocations')}}">
                                {{trans('common.ShippingLocations')}}
                            </span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item @if(isset($active) && $active == 'blogs') active @endif">
                <a class="d-flex align-items-center" href="{{route('admin.blogs')}}">
                  <i data-feather='book-open'></i>
                  <span class="menu-title text-truncate" data-i18n="{{trans('common.blogs')}}">
                    {{trans('common.blog')}}
                  </span>
                </a>
              </li>
            <li class="nav-item @if(isset($active) && $active == 'orders') active @endif">
                <a class="d-flex align-items-center" href="{{route('admin.orders')}}">
                    <i data-feather='shopping-cart'></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.orders')}}">
                        {{trans('common.orders')}}
                    </span>
                </a>
            </li>
            <li class="nav-item @if(isset($active) && $active == 'coupons') active @endif">
                <a class="d-flex align-items-center" href="{{route('admin.coupons.index')}}">
                    <i data-feather='shopping-cart'></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.coupons')}}">
                        {{trans('common.coupons')}}
                    </span>
                </a>
            </li>

            <li class="nav-item @if(isset($active) && $active == 'polices') active @endif">
                <a class="d-flex align-items-center" href="{{route('admin.polices')}}">
                    <i data-feather='sliders'></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.policesPrivacies')}}">
                        {{ trans('common.policesPrivacies') }}
                    </span>
                </a>
            </li>
            <li class="nav-item @if(isset($active) && $active == 'faqs') active @endif">
                <a class="d-flex align-items-center" href="{{route('admin.faqs')}}">
                    <i data-feather='help-circle'></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.FAQs')}}">
                        {{trans('common.FAQs')}}
                    </span>
                </a>
            </li>
            <li class="nav-item @if(isset($active) && $active == 'contactMessages') active @endif">
                <a class="d-flex align-items-center" href="{{route('admin.contactmessages')}}">
                    <i data-feather='mail'></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.contactMessages')}}">
                        {{trans('common.contactMessages')}}
                    </span>
                </a>
            </li>
            <li class="nav-item @if(isset($active) && $active == 'subscribe') active @endif">
                <a class="d-flex align-items-center" href="{{route('admin.subscribe')}}">
                    <i data-feather='mail'></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.subscribeMessages')}}">
                        {{trans('common.subscribeMessages')}}
                    </span>
                </a>
            </li>
            <li class="nav-item @if(isset($active) && $active == 'reviews') active @endif">
                <a class="d-flex align-items-center" href="{{route('admin.reviews')}}">
                    <i data-feather='mail'></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.reviews')}}">
                        {{trans('common.reviews')}}
                    </span>
                </a>
            </li>
            <li class=" navigation-header">
                <span data-i18n="{{trans('common.helpingLinks')}}">{{trans('common.helpingLinks')}}</span>
            </li>
            <li class="nav-item">
                <a class="d-flex align-items-center" href="{{url('/')}}" target="_blank">
                    <i data-feather='mail'></i>
                    <span class="menu-title text-truncate" data-i18n="{{trans('common.PreviewWebsiteHome')}}">
                        {{trans('common.PreviewWebsiteHome')}}
                    </span>
                </a>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu-->
