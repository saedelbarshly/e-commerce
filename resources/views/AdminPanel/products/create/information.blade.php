<!-- form -->
<div class="divider">
  <div class="divider-text">{{trans('common.information')}}</div>
</div>
<div class="form-group row mb-2">
    <label class="col-sm-2 col-form-label" for="type">{{ trans('common.type') }}</label>
    <div class="col-sm-10">
        {{Form::text('type','',['id'=>'type','class'=>'form-control'])}}
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-sm-2 col-form-label" for="price">{{ trans('common.price') }}</label>
    <div class="col-sm-10">
        {{Form::text('price','',['id'=>'price','class'=>'form-control'])}}
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-sm-2 col-form-label" for="tax_type_id">{{ trans('common.taxType') }}</label>
    <div class="col-sm-10">
        {{Form::select('tax_type_id',$taxTypes,'',['id'=>'tax_type_id','class'=>'form-control'])}}
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-sm-2 col-form-label" for="quantity">{{ trans('common.quantity') }}</label>
    <div class="col-sm-10">
        {{Form::number('quantity','',['id'=>'quantity','class'=>'form-control', 'min'=>0])}}
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-sm-2 col-form-label" for="min_quantity">{{ trans('common.min_quantity') }}</label>
    <div class="col-sm-10">
        {{Form::number('min_quantity','',['id'=>'min_quantity','class'=>'form-control', 'min'=>0])}}
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-sm-2 col-form-label" for="discountFromAvailableProducts">{{ trans('common.discountFromAvailableProducts') }}</label>
    <div class="col-sm-10">
        {{ Form::select('discountFromAvailableProducts',[
          1=> 'نعم',
          0=> 'لا'
          ],'',['id'=>'discountFromAvailableProducts','class'=>'form-control']) }}
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-sm-2 col-form-label" for="unavailableProductStatus">{{ trans('common.unavailableProductStatus') }}</label>
    <div class="col-sm-10">
        {{ Form::select('unavailableProductStatus',[
          'available'=> 'متاح',
          'unavailable'=> 'غير متاح',
          'Pre-booking'=> 'متاح للحجز مسبقاً',
          'availableAfterTwoDays'=> 'متاح بعد يومين',
          ],'',['id'=>'unavailableProductStatus','class'=>'form-control']) }}
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-sm-2 col-form-label" for="shipping">{{ trans('common.shipping') }}</label>
    <div class="col-sm-10">
        {{ Form::select('shipping',[
          1=> 'نعم',
          0=> 'لا'
          ],'',['id'=>'shipping','class'=>'form-control']) }}
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-sm-2 col-form-label" for="dimensions">{{ trans('common.dimensions') }}</label>
    <div class="col-sm-3">
      {{Form::number('length','',['id'=>'price','class'=>'form-control', 'placeholder'=>'الطول'])}}
    </div>
    <div class="col-sm-3">
      {{Form::number('width','',['id'=>'price','class'=>'form-control', 'placeholder'=>'العرض'])}}
    </div>
    <div class="col-sm-4">
      {{Form::number('height','',['id'=>'price','class'=>'form-control', 'placeholder'=>'الارتفاع'])}}
    </div>
</div>
<div class="form-group row mb-2">
  <label class="col-sm-2 col-form-label" for="length_id">{{ trans('common.lengthType') }}</label>
  <div class="col-sm-10">
    {{Form::select('length_id',$lengths,'',['id'=>'length_id','class'=>'form-control'])}}
  </div>
</div>
<div class="form-group row mb-2">
    <label class="col-sm-2 col-form-label" for="weight">{{ trans('common.weight') }}</label>
    <div class="col-sm-10">
      {{Form::number('weight','',['id'=>'weight','class'=>'form-control', 'placeholder'=>'الوزن'])}}
    </div>
</div>
<div class="form-group row mb-2">
  <label class="col-sm-2 col-form-label" for="weights_id">{{ trans('common.weightType') }}</label>
  <div class="col-sm-10">
    {{Form::select('weights_id',$weights,'',['id'=>'weights_id','class'=>'form-control'])}}
  </div>
</div>
<div class="form-group row mb-2">
  <label class="col-sm-2 col-form-label" for="status">{{ trans('common.status') }}</label>
  <div class="col-sm-10">
    {{Form::select('status',
    [
      1 => 'مفعل',
      0 => 'غير مفعل'
    ],'',['id'=>'status','class'=>'form-control'])}}
  </div>
</div>
<div class="form-group row mb-2">
  <label class="col-sm-2 col-form-label" for="ordering">{{ trans('common.ordering') }}</label>
  <div class="col-sm-10">
    {{Form::number('ordering','',['id'=>'ordering','class'=>'form-control', 'min'=>0])}}
  </div>
</div>

