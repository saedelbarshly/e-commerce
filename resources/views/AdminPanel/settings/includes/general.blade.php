<!-- form -->
<div class="row">
    <div class="divider">
        <div class="divider-text">{{trans('common.siteMainSEO')}}</div>
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="siteTitle_ar">{{trans('common.siteTitle_ar')}}</label>
        {{Form::text('siteTitle_ar',getSettingValue('siteTitle_ar'),['id'=>'siteTitle_ar','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="siteTitle_en">{{trans('common.siteTitle_en')}}</label>
        {{Form::text('siteTitle_en',getSettingValue('siteTitle_en'),['id'=>'siteTitle_en','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12">
        <label class="form-label" for="siteDescription_ar">{{trans('common.siteDescription_ar')}}</label>
        {{Form::textarea('siteDescription_ar',getSettingValue('siteDescription_ar'),['rows'=>'3','id'=>'siteDescription_ar','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12">
        <label class="form-label" for="siteDescription_en">{{trans('common.siteDescription_en')}}</label>
        {{Form::textarea('siteDescription_en',getSettingValue('siteDescription_en'),['rows'=>'3','id'=>'siteDescription_en','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12">
        <label class="form-label" for="siteKeywords_ar">{{trans('common.siteKeywords_ar')}}</label>
        {{Form::textarea('siteKeywords_ar',getSettingValue('siteKeywords_ar'),['rows'=>'3','id'=>'siteKeywords_ar','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12">
        <label class="form-label" for="siteKeywords_en">{{trans('common.siteKeywords_en')}}</label>
        {{Form::textarea('siteKeywords_en',getSettingValue('siteKeywords_en'),['rows'=>'3','id'=>'siteKeywords_en','class'=>'form-control'])}}
    </div>

    
    <div class="col-12 col-md-12">
        <label class="form-label" for="header_codes">أكواد إضافية في منطقة header</label>
        {{Form::textarea('header_codes',getSettingValue('header_codes'),['rows'=>'3','id'=>'header_codes','class'=>'form-control'])}}
    </div>
    
    <div class="col-12 col-md-12">
      <label class="form-label" for="footer_codes">أكواد إضافية في منطقة footer</label>
        {{Form::textarea('footer_codes',getSettingValue('footer_codes'),['rows'=>'3','id'=>'footer_codes','class'=>'form-control'])}}
    </div>



</div>
<!--/ form -->
