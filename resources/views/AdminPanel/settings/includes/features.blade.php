<div class="row">
  @for ($i = 1; $i <= 4; $i++)
    <h2 class="text-bold mt-2">{{trans('common.features'). ' #' . $i}}</h2>
    <div class="col-12 col-md-6">
      <label class="form-label" for="featureTitle{{$i}}_ar">{{trans('common.title_ar')}}</label>
      {{Form::text('featureTitle'.$i.'_ar', getSettingValue('featureTitle'.$i.'_ar'),['id'=>'featureTitle'.$i.'_ar','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-6">
      <label class="form-label" for="featureTitle{{$i}}_en">{{trans('common.title_en')}}</label>
      {{Form::text('featureTitle'.$i.'_en', getSettingValue('featureTitle'.$i.'_en'),['id'=>'featureTitle'.$i.'_en','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-6">
      <label class="form-label" for="featureDescription{{$i}}_ar">{{trans('common.description_ar')}}</label>
      {{Form::text('featureDescription'.$i.'_ar', getSettingValue('featureDescription'.$i.'_ar'),['id'=>'featureDescription'.$i.'_ar','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-6">
      <label class="form-label" for="featureDescription{{$i}}_en">{{trans('common.description_en')}}</label>
      {{Form::text('featureDescription'.$i.'_en', getSettingValue('featureDescription'.$i.'_en'),['id'=>'featureDescription'.$i.'_en','class'=>'form-control'])}}
    </div>

    <div class="col-12 col-md-12">
      <label class="form-label" for="featureImage{{$i}}">{{trans('common.icon')}}</label>
      {!! getSettingImageValue('featureImage'.$i) !!}
      <div class="file-loading">
        <input class="files" name="featureImage{{$i}}" type="file" id="featureImage{{$i}}">
      </div>
    </div>
  @endfor
</div>
