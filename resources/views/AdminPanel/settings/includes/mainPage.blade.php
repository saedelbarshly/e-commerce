<!-- form -->
<div class="row">
  <div class="col-12 col-md-12">
    <label class="form-label" for="notificationIcon">{{trans('common.icon')}}</label>
    {{Form::text('notificationIcon',getSettingValue('notificationIcon'),['id'=>'notificationIcon','class'=>'form-control'])}}
  </div>
  <div class="divider">
    <div class="divider-text">{{trans('common.notifications')}}</div>
  </div>
  <div class="col-12 col-md-6">
    <label class="form-label" for="mainPageNotification1_ar">{{trans('common.mainPageNotification1_ar')}}</label>
    {{Form::text('mainPageNotification1_ar',getSettingValue('mainPageNotification1_ar'),['id'=>'mainPageNotification1_ar','class'=>'form-control'])}}
  </div>
  <div class="col-12 col-md-6">
    <label class="form-label" for="mainPageNotification1_en">{{trans('common.mainPageNotification1_en')}}</label>
    {{Form::text('mainPageNotification1_en',getSettingValue('mainPageNotification1_en'),['id'=>'mainPageNotification1_en','class'=>'form-control'])}}
  </div>
  <div class="col-12 col-md-6">
    <label class="form-label" for="mainPageNotification2_ar">{{trans('common.mainPageNotification2_ar')}}</label>
    {{Form::text('mainPageNotification2_ar',getSettingValue('mainPageNotification2_ar'),['id'=>'mainPageNotification2_ar','class'=>'form-control'])}}
  </div>
  <div class="col-12 col-md-6">
    <label class="form-label" for="mainPageNotification2_en">{{trans('common.mainPageNotification2_en')}}</label>
    {{Form::text('mainPageNotification2_en',getSettingValue('mainPageNotification2_en'),['id'=>'mainPageNotification2_en','class'=>'form-control'])}}
  </div>
  <div class="col-12 col-md-6">
    <label class="form-label" for="mainPageNotification3_ar">{{trans('common.mainPageNotification3_ar')}}</label>
    {{Form::text('mainPageNotification3_ar',getSettingValue('mainPageNotification3_ar'),['id'=>'mainPageNotification3_ar','class'=>'form-control'])}}
  </div>
  <div class="col-12 col-md-6">
    <label class="form-label" for="mainPageNotification3_en">{{trans('common.mainPageNotification3_en')}}</label>
    {{Form::text('mainPageNotification3_en',getSettingValue('mainPageNotification3_en'),['id'=>'mainPageNotification3_en','class'=>'form-control'])}}
  </div>
  <div class="divider">
    <div class="divider-text">{{trans('common.slider')}}</div>
  </div>
  @for($i = 1; $i <= 4; $i++)
    <h2 class="text-bold mt-1">{{trans('common.slider'). ' #' . $i}}</h2>
    <div class="col-12 col-md-6">
      <label class="form-label" for="homeSliderTitle{{$i}}_ar">{{trans('common.title_ar')}}</label>
      {{Form::text('homeSliderTitle'.$i. '_ar', getSettingValue('homeSliderTitle'.$i. '_ar'),['id'=>'homeSliderTitle'.$i.'_ar','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-6">
      <label class="form-label" for="homeSliderTitle{{$i}}_en">{{trans('common.title_en')}}</label>
      {{Form::text('homeSliderTitle'.$i. '_en', getSettingValue('homeSliderTitle'.$i. '_en'),['id'=>'homeSliderTitle'.$i.'_en','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-6">
      <label class="form-label" for="homeSliderButtonTitle{{$i}}_ar">{{trans('common.buttonTitle_ar')}}</label>
      {{Form::text('homeSliderButtonTitle'.$i. '_ar', getSettingValue('homeSliderButtonTitle'.$i. '_ar'),['id'=>'homeSliderButtonTitle'.$i.'_ar','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-6">
      <label class="form-label" for="homeSliderButtonTitle{{$i}}_en">{{trans('common.buttonTitle_en')}}</label>
      {{Form::text('homeSliderButtonTitle'.$i. '_en', getSettingValue('homeSliderButtonTitle'.$i. '_en'),['id'=>'homeSliderButtonTitle'.$i.'_en','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12">
      <label class="form-label" for="buttonLink{{$i}}">{{trans('common.buttonLink')}}</label>
      {{Form::text('buttonLink'.$i, getSettingValue('buttonLink'.$i),['id'=>'buttonLink'.$i,'class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12">
      <label class="form-label" for="homeSliderImage{{$i}}">{{trans('common.image')}}</label>
      {!! getSettingImageValue('homeSliderImage'.$i) !!}
      <div class="file-loading">
        <input class="files" name="homeSliderImage{{$i}}" type="file">
      </div>
    </div>
  @endfor
</div>
<!--/ form -->
