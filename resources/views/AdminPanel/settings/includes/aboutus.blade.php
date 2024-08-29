<div class="row">
  <div class="divider">
    <div class="divider-text"><b>{{trans('common.aboutUs')}}</b></div>
  </div>
  <div class="col-12 col-md-6">
    <label class="form-label" for="aboutUsTitle_ar">{{ trans('common.title_ar') }}</label>
    {{Form::text('aboutUsTitle_ar',getSettingValue('aboutUsTitle_ar'),['id'=>'aboutUsTitle_ar','class'=>'form-control'])}}
  </div>
  <div class="col-12 col-md-6">
    <label class="form-label" for="aboutUsTitle_en">{{ trans('common.title_en') }}</label>
    {{Form::text('aboutUsTitle_en',getSettingValue('aboutUsTitle_en'),['id'=>'aboutUsTitle_en','class'=>'form-control'])}}
  </div>
  <div class="col-12 col-md-12">
    <label class="form-label" for="aboutUsDescription_ar">{{ trans('common.description_ar') }}</label>
    {{Form::textarea('aboutUsDescription_ar',getSettingValue('aboutUsDescription_ar'),['id'=>'aboutUsDescription_ar','class'=>'form-control editor_ar'
    ,'rows'=>4])}}
  </div>
  <div class="col-12 col-md-12">
    <label class="form-label" for="aboutUsDescription_en">{{ trans('common.description_en') }}</label>
    {{Form::textarea('aboutUsDescription_en',getSettingValue('aboutUsDescription_en'),['id'=>'aboutUsDescription_en','class'=>'form-control editor_en','rows'=>4])}}
  </div>
  <div class="col-md-6 text-center mt-2">
    <h3>{{ trans('common.image') }} </h3>
    {!! getSettingImageValue('aboutUsLogo') !!}
    <div class="file-loading">
      <input class="files" name="aboutUsLogo" type="file">
    </div>
  </div>
</div>
