<div class="row pt-2" id="create-specifications">
  <div class="divider col-11 col-sm-11">
    <div class="divider-text">{{trans('common.specifications')}}</div>
  </div>
  <div class="col-1 col-sm-1">
    <div class="btn btn-primary mt-1 me-1 btn-create-specifications"> <i data-feather="plus"></i></div>
  </div>
</div>
<div class="specifications-section">
  @foreach ($product->specifications as $specification)
    <div class="row pt-2 option-section">
      <div class="options-list-place">
        <div class="row  options-list">
          <div class="col-12 col-sm-2 mb-1">
            <label class="form-label" for="specification_id">{{trans('common.specifications')}}</label>
            {{Form::select('specification_id[]',$specifications, $specification->id,['id'=>'length_id','class'=>'form-control option-specification_id'])}}
          </div>
          <div class="col-12 col-sm-4 mb-1">
            <label class="form-label" for="specificationDescription_ar">{{trans('common.text_ar')}}</label>
            <input type="text" name="specificationDescription_ar[]" id="specificationDescription_ar"
              class="form-control option-specificationDescription_ar" value="{{$specification->pivot->description_ar}}">
          </div>
          <div class="col-12 col-sm-4 mb-1">
            <label class="form-label" for="specificationDescription_en">{{trans('common.text_en')}}</label>
            <input type="text" name="specificationDescription_en[]" id="specificationDescription_en"
              class="form-control option-specificationDescription_en" value="{{$specification->pivot->description_en}}">
          </div>
          <div class="col-12 col-sm-2 col-sm-1">
            <div class="btn btn-danger mt-1 me-1 btn-delete-option">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash"
                viewBox="0 0 16 16">
                <path
                  d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
                <path fill-rule="evenodd"
                  d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
              </svg>
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
@section("scripts")
  @include("AdminPanel.products.edit.script")
@stop
