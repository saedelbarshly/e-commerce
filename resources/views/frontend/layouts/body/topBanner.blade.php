<!-- collection banner -->
<section class="banner-padding banner-furniture ratio2_1">
  <div class="container-fluid">
    <div class="row partition4">
      @for($i = 1; $i <= 4; $i++)
      @if(getSettingValue('advertisementCode_'.$lang.$i) != '')
      <div class="col-lg-3 col-md-6 text-center">
        <a href="{{ getSettingValue('advertisementLink'.$i) }}">
        {!! getSettingValue('advertisementCode_'.$lang.$i) !!}
        </a>
      </div>
      @else
      <div class="col-lg-3 col-md-6">
        <a href="{{ getSettingValue('advertisementLink'.$i) }}">
          <div class="collection-banner p-right text-end">
            <div class="img-part">
              <img src="{{ getSettingImageLink('advertisementImage' . $i) }}" class="img-fluid blur-up lazyload bg-img" width="80%">
            </div>
          </div>
        </a>
      </div>
      @endif
      @endfor
    </div>
  </div>
</section>
<!-- collection banner end -->
