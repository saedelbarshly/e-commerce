  <?php /*
  <div class="col-12 col-md-2">
    <label class="repeater-title" for="select-box">{{trans('common.optionType')}}</label>
    <select class="form-select item-details" id="select-box" onchange="showForm()" name="option_type_id">
      <option value="" disabled>--إختيار النوع--</option>
      @foreach ($optionTypes as $key => $type)
        <option value="{{ $key }}" {{ $key == $product->option_type_id ? 'selected' : '' }}>
          {{ $type }}
        </option>
      @endforeach
    </select>
  </div>
  <div class="row pt-2" id="create-options" style="display: none">
    <div class="divider col-11 col-ms-11">
      <div class="divider-text">{{trans('common.options')}}</div>
    </div>
    <div class="col-1 col-ms-1">
      <div class="btn btn-primary btn-create-options"> <i data-feather="plus"></i></div>
    </div>
  </div>
  <div class="options-section">
    @foreach ($product->optionValues as $optionValue)
      <div class="row pt-3 option-section" id="formappend">
        <div class="options-list-place">
          <div class="row options-list">
            <div class="form-group row mb-2">
              <label class="col-sm-2 col-form-label" for="optionRequired">{{ trans('common.required') }}</label>
              <div class="col-sm-10">
                {{Form::select('optionRequired[]',[
                1 => "نعم",
                0 => "لا",
                ], $optionValue->pivot->optionRequired,['id'=>'optionRequired','class'=>'form-control'])}}
              </div>
            </div>
            <div class="col-12 col-sm-2 mb-1">
              <label class="form-label" for="option_value_id">{{trans('common.optionValue')}}</label>
              {{ Form::select('option_value_id[]', $optionValues,
              $optionValue->pivot->option_value_id
              , ['class' => 'form-control
              option-value','id'=>'option_value_id']) }}
            </div>
            <div class="col-12 col-sm-2 mb-1">
              <label class="form-label" for="optionQuantity">{{trans('common.quantity')}}</label>
              <input type="number" name="optionQuantity[]" id="optionQuantity" class="form-control option-quantity" min=0 value="{{ $optionValue->pivot->optionQuantity }}">
            </div>
            <div class="col-12 col-sm-3 mb-1">
              <label class="form-label"
                for="optionDiscountFromAvailableProducts">{{trans('common.discountFromAvailableProducts')}}</label>
              {{ Form::select('optionDiscountFromAvailableProducts[]',
              [
              1 => "نعم",
              0 => "لا",
              ],
              $optionValue->pivot->optionDiscountFromAvailableProducts,
              ['class' => 'form-control option-value','id'=>'optionDiscountFromAvailableProducts']) }}
            </div>
            <div class="col-12 col-sm-2 mb-1">
              <label class="form-label" for="optionPrice">{{trans('common.price')}}</label>
              <input type="number" name="optionPrice[]" step="1" id="optionPrice" class="form-control option-optionPrice" min=0 value="{{ $optionValue->pivot->optionPrice }}">
            </div>
            <div class="col-12 col-sm-2">
              <div class="btn btn-danger mt-2 me-1 btn-delete-option">
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
  */ ?>




  <div id="optionsWrapper">
    @foreach ($product_options as $key => $option)
      <div class="row">
        <div class="col-12 col-md-2 mb-2">
          <label class="repeater-title mb-1" for="select-box">اسم الخيار</label>      
          <select class="form-select item-details optionSelector" id="optionSelector" onchange="getOptionInputs(this)" name="optionSelector[]">
            <option value="" disabled selected>--إختيار النوع--</option>
            @foreach ($options as $key => $type)
              <option value="{{ $key }}" @if($option->option_id == $key) selected @endif>{{ $type }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-12 col-md-2 pt-1">
          <button type="button" class="btn btn-danger mt-2" onclick="removeThisOptionRow(this)">
            إزالة الخيار
          </button>
        </div>
        <div class="col-12"></div>
        <div class="options-section">

            @foreach ($option->options as $item)
              <div class="col-12 mb-1">
                <div class="row">
                  <div class="col-md-3">
                    <label for="">الاسم بالعربية</label>
                    <input type="text" name="" id="" class="form-control" value="{{$item->originalOptionValue != '' ? $item->originalOptionValue->name_ar : ''}}" disabled>
                  </div>
                  <div class="col-md-3">
                    <label for="">الاسم بالإنجليزية</label>
                    <input type="text" name="" id="" class="form-control" value="{{$item->originalOptionValue != '' ? $item->originalOptionValue->name_en : ''}}" disabled>
                  </div>
                  <div class="col-md-3">
                    <label for="">السعر الإضافي</label>
                    <input type="number" name="optionValuePrice[{{$option->option_id}}][{{$item->option_value_id}}]" id="" class="form-control" value="{{$item->price}}" step=".01">
                  </div>
                  <div class="col-12 col-md-2">
                    <button type="button" class="btn btn-danger mt-2" onclick="removeThisOptionItem(this)">
                      إزالة الخيار
                    </button>
                  </div>
                </div>
              </div>
            @endforeach

        </div>
      </div>
    @endforeach
  </div>

  <button type="button" class="btn btn-primary m-2" onclick="createNewOption()">
    إضافة خيارات
  </button>
