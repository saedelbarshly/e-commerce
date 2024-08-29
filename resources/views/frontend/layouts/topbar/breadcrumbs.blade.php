<div class="breadcrumb-section">
  <div class="container">
    <div class="row">
      <div class="col-sm-6">
        <div class="page-title">
          <h2>{{$title ?? trans('common.e-commerce') }}</h2>
        </div>
      </div>
      <div class="col-sm-6">
        <nav aria-label="breadcrumb" class="theme-breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('e-commerce.index') }}">{{ trans('common.home') }}</a></li>
            @if(isset($breadcrumbs))
              @foreach($breadcrumbs as $item)
                @if($item['url'] != '')
                  <li class="breadcrumb-item">
                    <a href="{{$item['url']}}">{{$item['text']}}</a>
                  </li>
                @else
                <li class="breadcrumb-item active">
                  {{$item['text']}}
                </li>
                @endif
              @endforeach
            @endif
          </ol>
        </nav>
      </div>
    </div>
  </div>
</div>
