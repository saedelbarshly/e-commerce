<li class="onhover-div mobile-setting">
  <div>
    {{-- <img src="{{ asset('frontend/assets/images/icon/setting.png') }}" class="img-fluid blur-up lazyload" alt="">
    --}}
    {{-- <i class="ti-settings"></i> --}}
    {{-- <span> {{trans('common.'.app()->getLocale())}} </span> --}}
    @foreach(panelLangMenu()['list'] as $singleLang)
    <a class="dropdown-item" href="{{url('/SwitchLang/'.$singleLang['lang'])}}" data-language="{{$singleLang['lang']}}">
      <i class="flag-icon flag-icon-{{$singleLang['flag']}}"></i> {{trans('common.'.$singleLang['text'])}}
    </a>
    @endforeach
  </div>
  {{-- <div class="show-div setting">
    <h6>{{ trans('common.language') }}</h6>
    <ul>
      @foreach(panelLangMenu()['list'] as $singleLang)
      <a class="dropdown-item" href="{{url('/SwitchLang/'.$singleLang['lang'])}}"
        data-language="{{$singleLang['lang']}}">
        <i class="flag-icon flag-icon-{{$singleLang['flag']}}"></i> {{trans('common.'.$singleLang['text'])}}
      </a>
      @endforeach
    </ul>
    <h6>currency</h6>
    <ul class="list-inline">
      <li><a href="#">euro</a></li>
      <li><a href="#">rupees</a></li>
      <li><a href="#">pound</a></li>
      <li><a href="#">doller</a></li>
    </ul>
  </div> --}}
</li>
