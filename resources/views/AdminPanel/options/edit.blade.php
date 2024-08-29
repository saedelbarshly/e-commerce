@extends('AdminPanel.layouts.master')
@section('content')
<div class="row">
  <div class="col-12">
    <!-- profile -->
    <div class="card">
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <div class="card-body py-2 my-25">
        {{Form::open(['files'=>'true','class'=>'validate-form','route' => ['admin.options.update', 'option' => $option->id]])}}
        <!-- form -->
        <div class="row pt-3">
          <div class="col-12 col-md-6">
            <label class="form-label" for="name_ar">{{trans('common.name_ar')}}</label>
            {{Form::text('name_ar',$option->name_ar,['id'=>'name_ar', 'class'=>'form-control','required'])}}
          </div>
          <div class="col-12 col-md-6">
            <label class="form-label" for="name_en">{{trans('common.name_en')}}</label>
            {{Form::text('name_en',$option->name_en,['id'=>'name_en', 'class'=>'form-control'])}}
          </div>
        <div class="col-12 col-md-12">
          <label class="repeater-title" for="option_type_id">{{trans('common.optionType')}}</label>
          {{ Form::select('option_type_id', $optionTypes,
          $option->option_type_id , ['class' => 'form-select item-details', 'id' => 'option_type_id', 'onchange'=>'showElemet(this.value)', 'placeholder' => '--إختيار النوع--']) }}
        </div>
        <div class="col-12 col-md-12">
          <label class="form-label" for="ordering">{{trans('common.ordering')}}</label>
          {{Form::number('ordering', $option->ordering ,['id'=>'ordering', 'step'=>'1', 'class'=>'form-control','required', 'min'=>0])}}
        </div>
        <div class="row pt-2" id="create-options" style="display: none">
            <div class="divider col-10 col-sm-10">
              <div class="divider-text">{{trans('common.options')}}</div>
            </div>
            <div class="col-2 col-sm-2" >
              <div class="btn btn-primary mt-1 me-1 btn-create-options"> <i data-feather="plus"></i></div>
            </div>
        </div>
        <div class="options-section">
        @foreach ($option->optionValues as $optionValue)
          <div class="row pt-3 option-section" id="formappend">
            <div class="options-list-place">
              <div class="row  options-list">
                <input type="hidden" name="option_id[]" value="{{ $option->id }}">
                <div class="col-12 col-sm-3 mb-1">
                  <label class="form-label" for="optionname_ar">{{trans('common.option_name_ar')}}</label>
                  <input type="text" name="option_name_ar[]" id="optionname_ar" class="form-control option-name_ar" value="{{ $optionValue->name_ar }}">
                </div>
                <div class="col-12 col-sm-3 mb-1">
                  <label class="form-label" for="optionname_en">{{trans('common.option_name_en')}}</label>
                  <input type="text" name="option_name_en[]" id="optionname_en" class="form-control option-name_en" value="{{ $optionValue->name_en }}">
                </div>
                <div class="col-12 col-sm-3 mb-1">
                  <label class="form-label" for="option_ordering">{{trans('common.ordering')}}</label>
                  <input type="number" name="option_ordering[] " step="1" id="option_ordering"
                    class="form-control option-ordering" value="{{ $optionValue->ordering }}">
                </div>
                <div class="col-12 col-sm-3 col-sm-1">
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
          <div class="col-12">
            <button type="submit" class="btn btn-primary mt-1 me-1">{{trans('common.Save changes')}}</button>
          </div>
        </div>
        <!--/ form -->
        {{Form::close()}}
      </div>
    </div>
  </div>
</div>
@stop

@section("scripts")
<script>
  $("body").on("click", ".btn-create-options", function() {
        var html   = `
            <div class="row pt-3 option-section" id="formappend">
                <div class="options-list-place">
                 <div class="row  options-list">
                  <input type="hidden" name="option_id[]" value="{{ $option->id }}">
                    <div class="col-12 col-sm-3 mb-1">
                      <label class="form-label" for="optionname_ar">{{trans('common.option_name_ar')}}</label>
                      <input type="text" name="option_name_ar[]" id="optionname_ar" class="form-control option-name_ar">
                    </div>
                    <div class="col-12 col-sm-3 mb-1">
                      <label class="form-label" for="optionname_en">{{trans('common.option_name_en')}}</label>
                      <input type="text" name="option_name_en[]" id="optionname_en" class="form-control option-name_en">
                    </div>
                    <div class="col-12 col-sm-3 mb-1">
                        <label class="form-label" for="option_ordering">{{trans('common.ordering')}}</label>
                        <input type="number" name="option_ordering[] " step="1" id="option_ordering" class="form-control option-ordering">
                        <ipnut type="hidden" name="plusInput_id" value="0">
                    </div>
                    <div class="col-12 col-sm-3 col-sm-1">
                        <div class="btn btn-danger mt-1 me-1 btn-delete-option">
                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                            <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                           </svg>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        `;
     $('.options-section').append(html);
    });
    $("body").on("click",".btn-create-option", function(e){
            e.preventDefault();
             const inputId = $(this).parent().parent().find("#inputs").val(),
              optionSelection = $(this).parent().parent().parent().parent(),
              option =  optionSelection.find(".options-list"),
              options = `
                        <div class="row  options-list" id="formappend">
                          <input type="hidden" name="option_id" value="${inputId}">
                              <div class="col-12 col-sm-3 mb-1">
                                  <label class="form-label" for="optionname_ar">{{trans('common.option_name_ar')}}</label>
                                  <input type="text" name="option_name_ar[][${inputId}]" id="optionname" class="form-control option-name_ar">
                              </div>
                              <div class="col-12 col-sm-3 mb-1">
                                  <label class="form-label" for="optionname_en">{{trans('common.option_name_en')}}</label>
                                  <input type="text" name="option_name_en[][${inputId}]" id="optionname_en" class="form-control option-name_en">
                              </div>
                              <div class="col-12 col-sm-3 mb-1">
                                  <label class="form-label" for="value">{{trans('common.value')}}</label>
                                  <input type="text" name="option_value[][${inputId}]" id="value" class="form-control option-value">

                              </div>

                              <div class="col-12 col-sm-3 mb-1">
                                  <label class="form-label" for="price">{{trans('common.price')}}</label>
                                  <input type="number" name="option_price[][${inputId}]" step="1" id="price" class="form-control option-price">

                              </div>
                              <div class="col-12 col-sm-3 col-sm-1">
                                  <div class="btn btn-danger mt-1 me-1 btn-delete-option">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                      <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                      <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                    </svg>

                                  </div>

                              </div>
                          </div>
            `;
                option.find(".option-name").attr('name', `option_name[][${inputId}]`).val('');
                option.find(".option-value").attr('name', `option_value[][${inputId}]`).val('');
                option.find(".option-price").attr('name', `option_price[][${inputId}]`).val('');

             if (optionSelection.find(".options-list-place").length <= 1) {
                    optionSelection.find(".options-list-place").append(options);
            }
        });

    $("body").on("change", "#inputs", function() {
        const optionPlace = $(this).parent().parent().parent().parent();
            optionPlace.find(".option-name").attr('name', `option_name[][${$(this).val()}]`);
            optionPlace.find(".option-value").attr('name', `option_value[][${$(this).val()}]`);
            optionPlace.find(".option-price").attr('name', `option_price[][${$(this).val()}]`);
    });
    $("body").on("click", ".btn-delete-option", function() {
        if ($(".options-list-place").find(".options-list").length > 1) {
            $(this).parent().parent().remove();
        }
    });
    $("body").on("click", ".btn-delete-options", function() {
        if ($(".options-list-place").find(".btn-delete-options").length < 1) {
            $(this).parent().parent().parent().parent().remove();
        } else {
            alert('لا يمكنك إزالة هذا الحقل حيث لا يوجد غيره');
        }
    });
</script>
<script>
  function showElemet(val) {
    console.log(val);
    if (val === '1' || val === '2' || val === '3'){
        $('#create-options').show();
        $('#formappend').show();
    }else {
        $('#create-options').hide();
        $('#formappend').hide();
    }
  }
</script>
@stop
