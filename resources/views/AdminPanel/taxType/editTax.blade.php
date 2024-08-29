<div class="row pt-3 option-section">
  <div class="options-list-place">
    <div class="row  options-list">
      <div class="col-12 col-md-4 mb-1">
        <label class="form-label" for="option_taxRateID">{{trans('common.taxRate')}}</label>
        <select name="option_taxRateID[]" id="option_taxRateID" class="form-control option-taxRateID" required>
          <option disabled selected> --اختر سعر الضريبة--</option>
          @foreach($taxRates as $Rate)
            <option value="{{$Rate->id}}" {{ ($Rate->id == $item->tax_rate_id) ? 'selected' : '' }}> 
              {{$Rate->name_ar}}
            </option>
          @endforeach
        </select>
      </div>
      <div class="col-12 col-md-4 mb-1">
        <label class="form-label" for="option_baseOn">{{trans('common.baseOn')}}</label>
        <select name="option_baseOn[]" id="option_baseOn" class="form-control option-baseOn" required>
          <option disabled selected>--اختر--</option>
          <option value="ShippingAddress" {{($item->basedOn == "ShippingAddress") ? 'selected': '' }}>عنوان الشحن</option>
          <option value="PaymentAddress" {{($item->basedOn == "PaymentAddress") ? 'selected': '' }}>عنوان الدفع</option>
          <option value="StoreAddress" {{($item->basedOn == "StoreAddress") ? 'selected': '' }}>عنوان المتجر</option>
        </select>
      </div>
      <div class="col-12 col-sm-3 mb-1">
        <label class="form-label" for="option_priority">{{trans('common.priority')}}</label>
        <input type="number" name="option_priority[]" step="1" min="0" id="option_priority"
          class="form-control option-priority" required value="{{ $item->priority }}">
      </div>
      <div class="col-12 col-sm-1 col-sm-1">
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
