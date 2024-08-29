<!-- form -->
<div class="row">
    <div class="col-md-3 text-center">
      <h3>{{ trans('common.image') }} </h3>
      {!! getProductImageValue($product->mainImage) !!}
        <div class="file-loading">
            <input class="files" name="mainImage" type="file" accept="image/*" data-show-upload="false" data-msg-placeholder="Select {files} for upload..."
                data-allowed-file-extensions='["jpg", "jpeg", "png", "gif"]'>
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
  @foreach ($product->productImages as $image)
  <div class="options-list-place">
    <div class="row  options-list">
      @if($image->additionalImages != '')
      {!! getImageValue($image->additionalImages) !!}
      <div class="col-12 col-sm-4 mb-1">
        <div class="file-loading">
          <input class="files" name="additionalImages[]" type="file">
        </div>
      </div>
      <div class="col-12 col-sm-3 col-sm-1 mb-1">
        <div class="btn btn-danger me-1 btn-delete-option">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash"
            viewBox="0 0 16 16">
            <path
              d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z" />
            <path fill-rule="evenodd"
              d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z" />
          </svg>
        </div>
      </div>
      @endif
    </div>
  </div>
  @endforeach
</div>
<!--/ form -->
