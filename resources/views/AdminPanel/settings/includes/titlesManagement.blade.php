<div class="row">
  <div class="divider">
    <div class="divider-text"><b>{{trans('common.productsDepartment')}}</b></div>
  </div>
  <div class="col-12 col-md-6">
    <label class="form-label" for="productsTitle_ar">{{ trans('common.title_ar') }}</label>
    {{Form::text('productsTitle_ar',getSettingValue('productsTitle_ar'),['id'=>'productsTitle_ar','class'=>'form-control'])}}
  </div>
  <div class="col-12 col-md-6">
    <label class="form-label" for="productsTitle_en">{{ trans('common.title_en') }}</label>
    {{Form::text('productsTitle_en',getSettingValue('productsTitle_en'),['id'=>'productsTitle_en','class'=>'form-control'])}}
  </div>
  <div class="col-12 col-md-12">
    <label class="form-label" for="productsDescription_ar">{{ trans('common.description_ar') }}</label>
    {{Form::textarea('productsDescription_ar',getSettingValue('productsDescription_ar'),['id'=>'productsDescription_ar','class'=>'form-control' ,'rows'=>3])}}
  </div>
  <div class="col-12 col-md-12">
    <label class="form-label" for="productsDescription_en">{{ trans('common.description_en') }}</label>
    {{Form::textarea('productsDescription_en',getSettingValue('productsDescription_en'),['id'=>'productsDescription_en','class'=>'form-control','rows'=>3])}}
  </div>
  <div class="divider">
    <div class="divider-text"><b>{{trans('common.underAdvertising')}}</b></div>
  </div>
  <div class="col-12 col-md-6">
    <label class="form-label" for="categoriesTitle_ar">{{ trans('common.title_ar') }}</label>
    {{Form::text('categoriesTitle_ar',getSettingValue('categoriesTitle_ar'),['id'=>'categoriesTitle_ar','class'=>'form-control'])}}
  </div>
  <div class="col-12 col-md-6">
    <label class="form-label" for="categoriesTitle_en">{{ trans('common.title_en') }}</label>
    {{Form::text('categoriesTitle_en',getSettingValue('categoriesTitle_en'),['id'=>'categoriesTitle_en','class'=>'form-control'])}}
  </div>
  <div class="divider">
    <div class="divider-text"><b>{{trans('common.blog')}}</b></div>
  </div>
  <div class="col-12 col-md-6">
    <label class="form-label" for="blogTitle_ar">{{ trans('common.title_ar') }}</label>
    {{Form::text('blogTitle_ar',getSettingValue('blogTitle_ar'),['id'=>'blogTitle_ar','class'=>'form-control'])}}
  </div>
  <div class="col-12 col-md-6">
    <label class="form-label" for="blogTitle_en">{{ trans('common.title_en') }}</label>
    {{Form::text('blogTitle_en',getSettingValue('blogTitle_en'),['id'=>'blogTitle_en','class'=>'form-control'])}}
  </div>
</div>
