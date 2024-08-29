<!-- form -->
<div class="divider">
  <div class="divider-text">{{trans('common.links')}}</div>
</div>
<div class="form-group row mb-2">
  <label class="col-sm-2 col-form-label" for="company_id">{{ trans('common.companies') }}</label>
  <div class="col-sm-10">
    <select name="company_id" id="company_id" class="form-control">
      <option disabled selected>--اختر الشركة--</option>
      @foreach ($companies as $key => $company)
      <option value={{ $key }} {{ ($key == $product->company_id) ? 'selected' : '' }}> {{ $company }}</option>
      @endforeach
    </select>
  </div>
</div>
<div class="form-group row mb-2">
  <label class="col-sm-2 col-form-label" for="category_id">{{ trans('common.categories') }}</label>
  <div class="col-sm-10">
    <select name="category_id" id="category_id" class="form-control">
      <option disabled selected>--اختر القسم--</option>
      @foreach ($categories as $key => $category)
      <option value={{ $key }} {{ ($key == $product->category_id) ? 'selected' : '' }}> {{ $category }}</option>
      @endforeach
    </select>
  </div>
</div>
<div class="form-group row mb-2">
  <label class="col-sm-2 col-form-label" for="relatedProducts">{{ trans('common.relatedProducts') }}</label>
  <div class="col-sm-10">
    {{Form::text('relatedProducts',$product->relatedProducts,['id'=>'relatedProducts','class'=>'form-control', 'placeholder'=>'المنتجات المرتبطة'])}}
  </div>
</div>
