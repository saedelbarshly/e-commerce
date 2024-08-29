<!-- form -->
<div class="row">
    <div class="col-md-4 m-2 text-center">
      <h3>{{ trans('common.logo') }} </h3>
        {!! getSettingImageValue('logo') !!}
        <div class="file-loading">
            <input class="files" name="logo" type="file">
        </div>
    </div>
    <div class="col-md-4 m-2 text-center">
      <h3>{{ trans('common.productsMainImage') }} </h3>
        {!! getSettingImageValue('productsMainImage') !!}
        <div class="file-loading">
            <input class="files" name="productsMainImage" type="file">
        </div>
    </div>
    <div class="divider">
      <div class="divider-text">{{trans('common.paymentImages')}}</div>
    </div>
    <div class="col-md-4 text-center">
      <h3>{{ trans('common.PayPal') }} </h3>
      {!! getSettingImageValue('PayPalImage') !!}
      <div class="file-loading">
        <input class="files" name="PayPalImage" type="file">
      </div>
    </div>
    <div class="col-md-4 text-center">
      <h3>{{ trans('common.Mastercard') }} </h3>
      {!! getSettingImageValue('Mastercard') !!}
      <div class="file-loading">
        <input class="files" name="MastercardImage" type="file">
      </div>
    </div>
    <div class="col-md-4 text-center">
      <h3>{{ trans('common.Visa') }} </h3>
      {!! getSettingImageValue('Visa') !!}
      <div class="file-loading">
        <input class="files" name="VisaImage" type="file">
      </div>
    </div>
</div>
<!--/ form -->
