<!-- form -->
<div class="row">
    <div class="col-12 col-md-4">
        <label class="form-label" for="phone">{{trans('common.phone')}}</label>
        {{Form::text('phone',getSettingValue('phone'),['id'=>'phone','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-4">
        <label class="form-label" for="mobile">{{trans('common.mobile')}}</label>
        {{Form::text('mobile',getSettingValue('mobile'),['id'=>'mobile','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-4">
        <label class="form-label" for="email">{{trans('common.email')}}</label>
        {{Form::text('email',getSettingValue('email'),['id'=>'email','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12">
        <label class="form-label" for="address_ar">{{trans('common.address_ar')}}</label>
        {{Form::text('address_ar',getSettingValue('address_ar'),['id'=>'address_ar','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12">
        <label class="form-label" for="address_en">{{trans('common.address_en')}}</label>
        {{Form::text('address_en',getSettingValue('address_en'),['id'=>'address_en','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-12">
        <label class="form-label" for="map">{{trans('common.map')}}</label>
        {{Form::textarea('map',getSettingValue('map'),['id'=>'map','class'=>'form-control','rows'=>'3'])}}
    </div>
</div>
<!--/ form -->
