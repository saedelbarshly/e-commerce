<!-- form -->
<div class="row">
    <div class="col-md-3 text-center">
      <h3>{{ trans('common.image') }} </h3>
        <div class="file-loading">
            <input class="files" name="mainImage" type="file">
        </div>
    </div>
</div>
<div class="row pt-2">
  <div class="divider col-11 col-sm-11">
    <div class="divider-text">{{trans('common.additionalImages')}}</div>
  </div>
  <div class="col-1 col-sm-1">
    <div class="btn btn-primary mt-1 me-1 btn-create-images"> <i data-feather="plus"></i></div>
  </div>
</div>
<div class="row pt-1 images-section">
</div>
<!--/ form -->
