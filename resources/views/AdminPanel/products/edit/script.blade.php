<script>
  $("body").on("click", ".btn-create-specifications", function() {
    var html = `
    <div class="row pt-2 option-section" id="formappend">
      <div class="options-list-place">
        <div class="row  options-list">
          <div class="col-12 col-sm-2 mb-1">
            <label class="form-label" for="specification_id">{{trans('common.specifications')}}</label>
            {{Form::select('specification_id[]',$specifications,'',['id'=>'length_id','class'=>'form-control
            option-specification_id'])}}
          </div>
          <div class="col-12 col-sm-4 mb-1">
            <label class="form-label" for="specificationDescription_ar">{{trans('common.text_ar')}}</label>
            <input type="text" name="specificationDescription_ar[]" id="specificationDescription_ar" class="form-control option-specificationDescription_ar">
          </div>
          <div class="col-12 col-sm-4 mb-1">
            <label class="form-label" for="specificationDescription_en">{{trans('common.text_en')}}</label>
            <input type="text" name="specificationDescription_en[]" id="specificationDescription_en" class="form-control option-specificationDescription_en">
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
    `;
    $('.specifications-section').append(html);
    });

    $("body").on("click", ".btn-delete-option", function() {
    $(this).parent().parent().remove();
    });
    //special Offers
    $("body").on("click", ".btn-create-specialOffers", function() {
    var html = `
    <div class="row pt-1 option-section">
      <div class="options-list-place">
        <div class="row  options-list">
          <div class="col-12 col-sm-2 mb-1">
            <label class="form-label" for="specialOfferPrice">{{trans('common.price')}}</label>
            <input type="number" name="specialOfferPrice[]" id="specialOfferPrice" class="form-control option-specialOfferPrice" min=0>
          </div>
          <div class="col-12 col-sm-2 mb-1">
            <label class="form-label" for="specialOfferPriority">{{trans('common.priority')}}</label>
            <input type="number" name="specialOfferPriority[]" id="specialOfferPriority" class="form-control option-specialOfferPriority" min=0>
          </div>
          <div class="col-12 col-sm-2 mb-1">
            <label class="form-label" for="specialOfferStartDate">{{trans('common.startDate')}}</label>
            <input type="date" name="specialOfferStartDate[]" id="specialOfferStartDate" class="form-control option-specialOfferStartDate" min=0>
          </div>
          <div class="col-12 col-sm-2 mb-1">
            <label class="form-label" for="specialOfferEndDate">{{trans('common.endDate')}}</label>
            <input type="date" name="specialOfferEndDate[]" id="specialOfferEndDate" class="form-control option-specialOfferEndDate" min=0>
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
    `;
    $('.specialOffers-section').append(html);
    });
    $("body").on("click", ".btn-delete-option", function() {
    $(this).parent().parent().remove();
    });
    //discounts
    $("body").on("click", ".btn-create-discounts", function() {
    var html = `
    <div class="row pt-1 option-section">
      <div class="options-list-place">
        <div class="row  options-list">
          <div class="col-12 col-sm-2 mb-1">
            <label class="form-label" for="DiscountQuantity">{{trans('common.quantity')}}</label>
            <input type="number" name="DiscountQuantity[]" id="DiscountQuantity"
              class="form-control option-DiscountQuantity" min=0>
          </div>
          <div class="col-12 col-sm-2 mb-1">
            <label class="form-label" for="DiscountPrice">{{trans('common.price')}}</label>
            <input type="number" name="DiscountPrice[]" id="DiscountPrice"
              class="form-control option-DiscountPrice" min=0>
          </div>
          <div class="col-12 col-sm-2 mb-1">
            <label class="form-label" for="DiscountPriority">{{trans('common.priority')}}</label>
            <input type="number" name="DiscountPriority[]" id="DiscountPriority"
              class="form-control option-DiscountPriority" min=0>
          </div>
          <div class="col-12 col-sm-2 mb-1">
            <label class="form-label" for="DiscountStartDate">{{trans('common.startDate')}}</label>
            <input type="date" name="DiscountStartDate[]" id="DiscountStartDate"
              class="form-control option-DiscountStartDate" min=0>
          </div>
          <div class="col-12 col-sm-2 mb-1">
            <label class="form-label" for="DiscountEndDate">{{trans('common.endDate')}}</label>
            <input type="date" name="DiscountEndDate[]" id="DiscountEndDate"
              class="form-control option-DiscountEndDate" min=0>
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
    `;
    $('.discounts-section').append(html);
    });
    $("body").on("click", ".btn-delete-option", function() {
    $(this).parent().parent().remove();
    });
    $("body").on("click", ".btn-delete-option", function() {
      if ($(".options-list-place").find(".options-list").length > 1) {
      $(this).parent().parent().remove();
      }
    });
    //Additional Images
    $("body").on("click", ".btn-create-images", function() {
    var html = `
      <div class="options-list-place mb-1 mt-1">
        <div class="row  options-list">
          <div class="col-12 col-sm-4 mb-1">
            <input type="file" name="additionalImages[]" id="additionalImages" class="form-control option-additionalImages">
          </div>
          <div class="col-12 col-sm-3 mb-1">
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
        </div>
      </div>
    `;
    $('.images-section').append(html);
    });
    $("body").on("click", ".btn-delete-option", function() {
    $(this).parent().parent().remove();
    });
</script>
<script>
  function showForm() {
        var selectBox = document.getElementById("select-box");
        var selectedValue = selectBox.options[selectBox.selectedIndex].value;
        var form1 = document.getElementById("create-options");
        if (selectedValue == 1 || selectedValue == 2 || selectedValue == 3) {
          form1.style.display = "block";
        }else {
          form1.style.display = "none";
        }
      }
  function getOptionInputs(elem) {
    var selectedOption = $(elem).find(":selected").val();
    console.log(selectedOption);
    $.ajax({    //create an ajax request to display.php
        type: "GET",
        url: "<?php echo url('/AdminPanel/products/getOptionDetails?option="+selectedOption+"'); ?>",             
        dataType: "html",   //expect html to be returned                
        success: function(data){ 
          var row = elem.parentNode.parentNode;
          var optionsSection = $(row).find('.options-section')
          $(optionsSection).empty().append(data);

        }
    });
  }

  function createNewOption() {
    var html = `
      <div class="row">
        <div class="col-12 col-md-2 mb-2">
          <label class="repeater-title mb-1" for="select-box">اسم الخيار</label>      
          <select class="form-select item-details optionSelector" id="optionSelector" onchange="getOptionInputs(this)" name="optionSelector[]">
            <option value="" disabled selected>--إختيار النوع--</option>
            @foreach ($options as $key => $type)
              <option value="{{ $key }}">{{ $type }}</option>
            @endforeach
          </select>
        </div>
        <div class="col-12 col-md-2 pt-1">
          <button type="button" class="btn btn-danger mt-2" onclick="removeThisOptionRow(this)">
            إزالة الخيار
          </button>
        </div>
        <div class="col-12"></div>
        <div class="options-section"></div>
      </div>
    `;
    console.log(html);
    $('#optionsWrapper').append(html);
  }

  function removeThisOptionRow(elem) {
    var row = elem.parentNode.parentNode;
    $(row).remove();
  }
  function removeThisOptionItem(elem) {
    var row = elem.parentNode.parentNode;
    $(row).remove();
  }
</script>
