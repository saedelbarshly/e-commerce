<div class="row pt-2" id="create-specifications">
  <div class="divider col-11 col-sm-11">
    <div class="divider-text">{{trans('common.specifications')}}</div>
  </div>
  <div class="col-1 col-sm-1">
    <div class="btn btn-primary mt-1 me-1 btn-create-specifications"> <i data-feather="plus"></i></div>
  </div>
</div>
<div class="specifications-section">
</div>
@section("scripts")
  @include("AdminPanel.products.create.script")
@stop
