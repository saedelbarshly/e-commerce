@extends('AdminPanel.layouts.master')
@section('content')
    <!-- Bordered table start -->
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{$title}}</h4>
                </div>
                <div>
                  @if ($errors->any())
                  <div class="alert alert-danger">
                    <ul>
                      @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                      @endforeach
                    </ul>
                  </div>
                  @endif
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-2">
                        <thead class="text-center">
                            <tr>
                                <th>{{trans('common.taxTypeName')}}</th>
                                <th class="text-center">{{trans('common.description')}}</th>
                                <th class="text-center">{{trans('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse($taxTypes as $taxType)
                            <tr id="row_{{$taxType->id}}">
                                <td>
                                    {{$taxType['name_ar']}}<br>
                                    {{$taxType['name_en']}}
                                </td>
                                <td class="text-center">
                                    {{$taxType->description_ar}}<br>
                                    {{$taxType['description_en']}}
                                </td>
                                <td class="text-center">
                                    <a href="javascript:;" data-bs-target="#edittaxType{{$taxType->id}}" data-bs-toggle="modal" class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.edit')}}">
                                        <i data-feather='edit'></i>
                                    </a>
                                    <?php $delete = route('admin.taxTypes.delete',['taxType'=>$taxType->id]); ?>
                                    <button type="button" class="btn btn-icon btn-danger" onclick="confirmDelete('{{$delete}}','{{$taxType->id}}')" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.delete')}}">
                                        <i data-feather='trash-2'></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-3 text-center ">
                                        <h2>{{trans('common.nothingToView')}}</h2>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @foreach($taxTypes as $taxType)
                    <div class="modal fade text-md-start" id="edittaxType{{$taxType->id}}" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
                            <div class="modal-content">
                                <div class="modal-header bg-transparent">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body pb-5 px-sm-5 pt-50">
                                    <div class="text-center mb-2">
                                        <h1 class="mb-1">{{trans('common.edit')}}</h1>
                                    </div>
                                    {{Form::open(['url'=>route('admin.taxTypes.update',['taxType'=>$taxType->id]), 'id'=>'edittaxTypeForm', 'class'=>'row gy-1 pt-75'])}}
                                        <div class="col-12 col-md-6">
                                          <label class="form-label" for="name_ar">{{trans('common.name_ar')}}</label>
                                          {{Form::text('name_ar',$taxType->name_ar,['id'=>'name_ar', 'class'=>'form-control','required'])}}
                                        </div>
                                        <div class="col-12 col-md-6">
                                          <label class="form-label" for="name_en">{{trans('common.name_en')}}</label>
                                          {{Form::text('name_en',$taxType->name_en,['id'=>'name_en', 'class'=>'form-control'])}}
                                        </div>
                                        <div class="col-12 col-md-12">
                                          <label class="form-label" for="description_ar">{{trans('common.description_ar')}}</label>
                                          {{Form::textarea('description_ar',$taxType->description_ar,['id'=>'description_ar', 'class'=>'form-control','required', 'rows'=>'3'])}}
                                        </div>
                                        <div class="col-12 col-md-12">
                                          <label class="form-label" for="description_en">{{trans('common.description_en')}}</label>
                                          {{Form::textarea('description_en',$taxType->description_en,['id'=>'description_en', 'class'=>'form-control','required', 'rows'=>'3'])}}
                                        </div>
                                        <div class="row pt-2" id="update-options">
                                          <div class="divider col-11 col-sm-11">
                                            <div class="divider-text">تكلفة الضريبة</div>
                                          </div>
                                          <div class="col-1 col-sm-1">
                                            <div class="btn btn-primary mt-1 me-1 btn-update-options"> <i data-feather="plus"></i></div>
                                          </div>
                                        </div>
                                        <div class="update-sections">
                                            @foreach($taxType->taxCosts as $item )
                                              @include('AdminPanel.taxType.editTax')
                                            @endforeach
                                          </div>
                                        <div class="col-12 text-center mt-2 pt-50">
                                            <button type="submit" class="btn btn-primary me-1">{{trans('common.Save changes')}}</button>
                                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                                {{trans('common.Cancel')}}
                                            </button>
                                        </div>
                                    {{Form::close()}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{ $taxTypes->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>
    <!-- Bordered table end -->
@stop
@section('page_buttons')
    <a href="javascript:;" data-bs-target="#createtaxType" data-bs-toggle="modal" class="btn btn-primary">
        {{trans('common.CreateNew')}}
    </a>
    <div class="modal fade text-md-start" id="createtaxType" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">{{trans('common.CreateNew')}}</h1>
                    </div>
                    {{Form::open(['url'=>route('admin.taxTypes.store'), 'id'=>'createtaxTypeForm', 'class'=>'row gy-1 pt-75'])}}
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="name_ar">{{trans('common.name_ar')}}</label>
                            {{Form::text('name_ar','',['id'=>'name_ar', 'class'=>'form-control','required'])}}
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="name_en">{{trans('common.name_en')}}</label>
                            {{Form::text('name_en','',['id'=>'name_en', 'class'=>'form-control'])}}
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="description_ar">{{trans('common.description_ar')}}</label>
                            {{Form::textarea('description_ar','',['id'=>'description_ar', 'class'=>'form-control','required', 'rows'=>'3'])}}
                        </div>
                        <div class="col-12 col-md-12">
                            <label class="form-label" for="description_en">{{trans('common.description_en')}}</label>
                            {{Form::textarea('description_en','',['id'=>'description_en', 'class'=>'form-control','required', 'rows'=>'3'])}}
                        </div>
                        <div class="row pt-2" id="create-options">
                            <div class="divider col-11 col-sm-11">
                              <div class="divider-text">تكلفة الضريبة</div>
                            </div>
                            <div class="col-1 col-sm-1">
                              <div class="btn btn-primary mt-1 me-1 btn-create-options"> <i data-feather="plus"></i></div>
                            </div>
                        </div>
                        <div class="options-section">

                        </div>
                        <div class="col-12 text-center mt-2 pt-50">
                            <button type="submit" class="btn btn-primary me-1">{{trans('common.Save changes')}}</button>
                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                {{trans('common.Cancel')}}
                            </button>
                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@stop
@section("scripts")
<script>
  $("body").on("click", ".btn-create-options", function() {
         const inputId = $('input[name=input_id]').val();
        var html   = `
            <div class="row pt-3 option-section" id="formappend">
                <div class="options-list-place">
                 <div class="row  options-list">
                   <div class="col-12 col-md-4 mb-1">
                      <label class="form-label" for="option_taxRateID">{{trans('common.taxRate')}}</label>
                        <select name="option_taxRateID[]" id="option_taxRateID" class="form-control option-taxRateID" required>
                          <option disabled selected > --اختر سعر الضريبة--</option>
                          @foreach($taxRates as $Rate)
                            <option value="{{$Rate->id}}"> {{$Rate->name_ar}}</option>
                          @endforeach
                        </select>
                    </div>
                   <div class="col-12 col-md-4 mb-1">
                      <label class="form-label" for="option_baseOn">{{trans('common.baseOn')}}</label>
                        <select name="option_baseOn[]" id="option_baseOn" class="form-control option-baseOn" required>
                          <option disabled selected>--اختر--</option>
                            <option value="ShippingAddress">عنوان الشحن</option>
                            <option value="PaymentAddress">عنوان الدفع</option>
                            <option value="StoreAddress">عنوان المتجر</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-3 mb-1">
                      <label class="form-label" for="option_priority">{{trans('common.priority')}}</label>
                      <input type="number" name="option_priority[]" step="1" min="0" id="option_priority" class="form-control option-priority" required>
                      <ipnut type="hidden" name="plusInput_id" value="0">
                    </div>
                    <div class="col-12 col-sm-1 col-sm-1">
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

    $("body").on("click", ".btn-delete-option", function() {
        $(this).parent().parent().remove();
        // if ($(".options-list-place").find(".options-list").length > 1) {
        // }
    });
</script>
<script>
  $("body").on("click", ".btn-update-options", function() {
        var html   = `
        <div class="row pt-3 update-section" >
          <div class="options-list-place">
                 <div class="row  options-list">
                   <div class="col-12 col-md-4 mb-1">
                      <label class="form-label" for="option_taxRateID">{{trans('common.taxRate')}}</label>
                        <select name="option_taxRateID[]" id="option_taxRateID" class="form-control option-taxRateID" required>
                          <option disabled> --اختر سعر الضريبة--</option>
                          @foreach($taxRates as $Rate)

                          @endforeach
                        </select>
                    </div>
                   <div class="col-12 col-md-4 mb-1">
                      <label class="form-label" for="option_baseOn">{{trans('common.baseOn')}}</label>
                        <select name="option_baseOn[]" id="option_baseOn" class="form-control option-baseOn" required>
                          <option disabled>--اختر--</option>
                            <option value="ShippingAddress" >عنوان الشحن</option>
                            <option value="PaymentAddress" >عنوان الدفع</option>
                            <option value="StoreAddress" >عنوان المتجر</option>
                        </select>
                    </div>
                    <div class="col-12 col-sm-3 mb-1">
                      <label class="form-label" for="option_priority">{{trans('common.priority')}}</label>
                      <input type="number" name="option_priority[]" step="1" id="option_priority" class="form-control option-priority"
                        value="" required>
                      <ipnut type="hidden" name="plusInput_id" value="0">
                    </div>
                    <div class="col-12 col-sm-1 col-sm-1">
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
     $('.update-sections').append(html);
    });

    $("body").on("click", ".btn-delete-option", function() {
        $(this).parent().parent().remove();
        // if ($(".options-list-place").find(".options-list").length > 1) {
        // }
    });
</script>
@stop
