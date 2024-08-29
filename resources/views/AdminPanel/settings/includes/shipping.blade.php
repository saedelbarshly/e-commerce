<!-- form -->
<div class="row">
    <div class="divider">
        <div class="divider-text">{{trans('common.aramexShippingApi')}}</div>
    </div>
    <div class="col-12 col-md-2">
        <label class="form-label" for="expreseShippingStatus">{{trans('common.expreseShippingStatus')}}</label>
        <div class="form-check form-check-success form-switch">
            {{Form::checkbox('expreseShippingStatus','1',getSettingValue('expreseShippingStatus') == '1' ? true : false,['id'=>'expreseShippingStatus', 'class'=>'form-check-input'])}}
            <label class="form-check-label" for="expreseShippingStatus"></label>
        </div>
    </div>
    <div class="col-12 col-md-4">
        <label class="form-label" for="username">{{trans('common.username')}}</label>
        {{Form::text('username',getSettingValue('username'),['id'=>'username','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-4">
        <label class="form-label" for="password">{{trans('common.password')}}</label>
        {{Form::text('password',getSettingValue('password'),['id'=>'password','class'=>'form-control'])}}
    </div>
    <div class="divider">
        <div class="divider-text">{{trans('common.freeShipping')}}</div>
    </div>
    <div class="col-12 col-md-2">
        <label class="form-label" for="freeShipping">{{trans('common.freeShipping')}}</label>
        <div class="form-check form-check-success form-switch">
            {{Form::checkbox('freeShipping','1',getSettingValue('freeShipping') == '1' ? true : false,['id'=>'freeShipping', 'class'=>'form-check-input'])}}
            <label class="form-check-label" for="freeShipping"></label>
        </div>
    </div>
    <div class="col-12 col-md-2">
        <label class="form-label" for="freeShippingTimeFrom">{{trans('common.ShippingTimeFrom')}}</label>
        {{Form::text('freeShippingTimeFrom',getSettingValue('freeShippingTimeFrom'),['id'=>'freeShippingTimeFrom', 'class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-2">
        <label class="form-label" for="freeShippingTimeTo">{{trans('common.ShippingTimeTo')}}</label>
        {{Form::text('freeShippingTimeTo',getSettingValue('freeShippingTimeTo'),['id'=>'freeShippingTimeTo', 'class'=>'form-control'])}}
    </div>
    <div class="divider">
        <div class="divider-text">{{trans('common.otherShippingMethod')}}</div>
    </div>
    <div class="col-12 col-md-2">
        <label class="form-label" for="otherShippingMethod">{{trans('common.otherShippingMethod')}}</label>
        <div class="form-check form-check-success form-switch">
            {{Form::checkbox('otherShippingMethod','1',getSettingValue('otherShippingMethod') == '1' ? true : false,['id'=>'otherShippingMethod', 'class'=>'form-check-input'])}}
            <label class="form-check-label" for="otherShippingMethod"></label>
        </div>
    </div>
    <div class="col-12 col-md-2">
        <label class="form-label" for="otherShippingMethodTimeFrom">{{trans('common.ShippingTimeFrom')}}</label>
        {{Form::text('otherShippingMethodTimeFrom',getSettingValue('otherShippingMethodTimeFrom'),['id'=>'otherShippingMethodTimeFrom', 'class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-2">
        <label class="form-label" for="otherShippingMethodTimeTo">{{trans('common.ShippingTimeTo')}}</label>
        {{Form::text('otherShippingMethodTimeTo',getSettingValue('otherShippingMethodTimeTo'),['id'=>'otherShippingMethodTimeTo', 'class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-3">
        <label class="form-label" for="otherShippingMethodFees">{{trans('common.otherShippingMethodFees')}}</label>
        {{Form::number('otherShippingMethodFees',getSettingValue('otherShippingMethodFees'),['id'=>'otherShippingMethodFees','class'=>'form-control'])}}
    </div>
</div>
<!--/ form -->