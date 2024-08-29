<div class="row">
  <div class="divider">
    <div class="divider-text">
      <b>{{trans('common.topBanner')}}</b>
    </div>
  </div>
  @for ($i = 1; $i <= 4; $i++)
  <h2 class="text-bold mt-2">{{trans('common.advertisement'). ' #' . $i}}</h2>
  <div class="col-12 col-md-12">
    <label class="form-label" for="advertisementLink{{ $i }}">{{trans('common.advertisementLink')}}</label>
    {{Form::text('advertisementLink'.$i,getSettingValue('advertisementLink'.$i),['id'=>'advertisementLink'.$i,'class'=>'form-control'])}}
  </div>
  <div class="col-12 col-md-12">
    <label class="form-label" for="advertisementImage{{ $i }}">{{trans('common.image')}}</label>
    {!! getSettingImageValue("advertisementImage$i ") !!}
    <div class="file-loading">
      <input class="files" name="advertisementImage{{ $i }}" type="file" id="advertisementImage{{ $i }}">
    </div>
  </div>
  <div class="col-12 col-md-12">
    <label class="form-label" for="advertisementCode_ar">{{ trans('common.advertisementCode_ar') }}</label>
    {{Form::textarea('advertisementCode_ar'. $i ,getSettingValue('advertisementCode_ar'. $i),['id'=>'advertisementCode_ar','class'=>'form-control
    editor_ar','rows'=>3])}}
  </div>
  <div class="col-12 col-md-12">
    <label class="form-label" for="advertisementCode_en">{{ trans('common.advertisementCode_en') }}</label>
    {{Form::textarea('advertisementCode_en'.$i,getSettingValue('advertisementCode_en'.$i),['id'=>'advertisementCode_en','class'=>'form-control
    editor_en','rows'=>3])}}
  </div>
  @endfor
  <div class="divider">
    <div class="divider-text">
      <b>{{trans('common.middleBanner')}} </b>
    </div>
  </div>
  <div class="col-12 col-md-12">
    <label class="form-label" for="middleBannerImage">{{trans('common.image')}}</label>
    {!! getSettingImageValue("middleBannerImage") !!}
    <div class="file-loading">
      <input class="files" name="middleBannerImage" type="file" id="middleBannerImage">
    </div>
  </div>
  <div class="divider">
    <div class="divider-text">
      <b>{{trans('common.popupModal')}} </b>
    </div>
  </div>
  <div class="col-12 col-md-12">
    <label class="form-label" for="popupModal">{{trans('common.image')}}</label>
    {!! getSettingImageValue("popupModal") !!}
    <div class="file-loading">
      <input class="files" name="popupModal" type="file" id="popupModal">
    </div>
  </div>
</div>
