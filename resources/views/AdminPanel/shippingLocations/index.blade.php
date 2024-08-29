@extends('AdminPanel.layouts.master')
@section('content')


<!-- Bordered table start -->
<div class="row" id="table-bordered">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">{{$title}}</h4>
      </div>
      @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
      <div class="table-responsive">
        <table class="table table-bordered mb-2">
          <thead>
            <tr>
              <th class="text-center">{{trans('common.name')}}</th>
              <th class="text-center">{{trans('common.price')}}</th>
              <th class="text-center">{{trans('common.actions')}}</th>
            </tr>
          </thead>
          <tbody class="text-center">
            @forelse($ShippingLocations as $location)
            <tr id="row_{{$location->id}}">
              <td>
                {{ $location->name_ar }} <br>
                {{ $location->name_en }}
              </td>
              <td>
                {{$location['price']}}
              </td>
              <td class="text-center">
                <a href="javascript:;" data-bs-target="#editsection{{$location->id}}" data-bs-toggle="modal"
                  class="btn btn-icon btn-info">
                  <i data-feather='edit' data-bs-toggle="tooltip" data-bs-placement="top"
                    data-bs-original-title="{{trans('common.edit')}}"></i>
                </a>
                <?php $delete = route('shippingLocations.delete',['location'=>$location->id]); ?>
                <button type="button" class="btn btn-icon btn-danger"
                  onclick="confirmDelete('{{$delete}}','{{$location->id}}')" data-bs-toggle="tooltip"
                  data-bs-placement="top" data-bs-original-title="{{trans('common.delete')}}">
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

      @foreach($ShippingLocations as $location)
      <div class="modal fade text-md-start" id="editsection{{$location->id}}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
          <div class="modal-content">
            <div class="modal-header bg-transparent">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
              <div class="text-center mb-2">
                <h1 class="mb-1">{{trans('common.edit')}}</h1>
              </div>
              {{Form::open(['url'=>route('shippingLocations.update',['location'=>$location->id]), 'id'=>'editsectionForm',
              'class'=>'row gy-1 pt-75'])}}
             <div class="col-12 col-md-6">
                <label class="form-label" for="name_ar">{{trans('common.name_ar')}}</label>
                {{Form::text('name_ar',$location->name_ar,['id'=>'name_ar', 'class'=>'form-control'])}}
              </div>
              <div class="col-12 col-md-6">
                <label class="form-label" for="name_en">{{trans('common.name_en')}}</label>
                {{Form::text('name_en',$location->name_en,['id'=>'name_en', 'class'=>'form-control'])}}
              </div>
              <div class="col-12">
                <label class="form-label" for="price">{{trans('common.price')}}</label>
                {{Form::number('price',$location->price,['id'=>'price', 'class'=>'form-control'])}}
              </div>
              <div class="row pt-2" id="create-locations">
                <div class="divider col-11 col-sm-11">
                  <div class="divider-text">تفاصيل مكان الشحن</div>
                </div>
                <div class="col-1 col-sm-1">
                  <div class="btn btn-primary mt-1 me-1 btn-create-locations-update"> <i data-feather="plus"></i></div>
                </div>
              </div>
              <div class="locations-section-update">
                @if($location->items->count() > 0)
                  @foreach($location->items as $item)
                    @include('AdminPanel.shippingLocations.updatelocationsItems')
                  @endforeach
                @endif
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

      {{ $ShippingLocations->links('vendor.pagination.default') }}

    </div>
  </div>
</div>
<!-- Bordered table end -->



@stop

@section('page_buttons')
<a href="javascript:;" data-bs-target="#createsection" data-bs-toggle="modal" class="btn btn-primary">
  {{trans('common.CreateNew')}}
</a>

<div class="modal fade text-md-start" id="createsection" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
    <div class="modal-content">
      <div class="modal-header bg-transparent">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body pb-5 px-sm-5 pt-50">
        <div class="text-center mb-2">
          <h1 class="mb-1">{{trans('common.CreateNew')}}</h1>
        </div>
        {{Form::open(['url'=>route('shippingLocations.store'), 'id'=>'createsectionForm', 'class'=>'row gy-1 pt-75'])}}
        <div class="col-12 col-md-6">
          <label class="form-label" for="name_ar">{{trans('common.name_ar')}}</label>
          {{Form::text('name_ar','',['id'=>'name_ar', 'class'=>'form-control'])}}
        </div>
        <div class="col-12 col-md-6">
          <label class="form-label" for="name_en">{{trans('common.name_en')}}</label>
          {{Form::text('name_en','',['id'=>'name_en', 'class'=>'form-control'])}}
        </div>
        <div class="col-12">
          <label class="form-label" for="price">{{trans('common.price')}}</label>
          {{Form::number('price','',['id'=>'price', 'class'=>'form-control'])}}
        </div>
        <div class="row pt-2" id="create-locations">
          <div class="divider col-11 col-sm-11">
            <div class="divider-text">تفاصيل مكان الشحن</div>
          </div>
          <div class="col-1 col-sm-1">
            <div class="btn btn-primary mt-1 me-1 btn-create-locations"> <i data-feather="plus"></i></div>
          </div>
        </div>
        <div class="locations-section">
            <div class="row pt-3 option-section">
                <div class="options-list-place">
                 <div class="row  options-list">
                   <div class="col-12 col-md-4 mb-1">
                      <label class="form-label" for="countryID">{{trans('common.Countries')}}</label>
                        <select name="countryID[]" id="countryID" class="form-control option-countryID" onchange="getGovernorate(this)" required>
                          <option value="0">كل الدول</option>
                            @foreach($countries as  $country)
                            <option value="{{$country->id}}">{{$country->name_ar}}</option>
                            @endforeach
                        </select>
                    </div>
                   <div class="col-12 col-md-4 mb-1">
                      <label class="form-label" for="governorateID">{{trans('common.governorates')}}</label>
                        <select name="governorateID[]" id="governorateID" class="form-control option-governorates" onchange="getCity(this)" required>
                            <option value="0">كل المحافظات</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-3 mb-1">
                      <label class="form-label" for="cityID">{{trans('common.city')}}</label>
                        <select name="cityID[]" id="cityID" class="form-control option-cityID" required>
                            <option value="0">كل المدن</option>
                        </select>
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
  $("body").on("click", ".btn-create-locations", function() {
        var $row =  1;
        var html   = `
            <div class="row pt-3 option-section">
                <div class="options-list-place">
                 <div class="row  options-list">
                   <div class="col-12 col-md-4 mb-1">
                      <label class="form-label" for="countryID">{{trans('common.Countries')}}</label>
                        <select name="countryID[]" id="countryID" class="form-control option-countryID" onchange="getGovernorate(this)" required>
                          <option value="0">كل الدول</option>
                            @foreach($countries as  $country)
                            <option value="{{$country->id}}">{{$country->name_ar}}</option>
                            @endforeach
                        </select>
                    </div>
                   <div class="col-12 col-md-4 mb-1">
                      <label class="form-label" for="governorateID">{{trans('common.governorates')}}</label>
                        <select name="governorateID[]" id="governorateID" class="form-control option-governorates" onchange="getCity(this)" required>
                            <option value="0">كل المحافظات</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-3 mb-1">
                      <label class="form-label" for="cityID">{{trans('common.city')}}</label>
                        <select name="cityID[]" id="cityID" class="form-control option-cityID" required>
                            <option value="0">كل المدن</option>
                        </select>
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
     $('.locations-section').append(html);
    });

    $("body").on("click", ".btn-delete-option", function() {
        $(this).parent().parent().remove();
        // if ($(".options-list-place").find(".options-list").length > 1) {
        // }
    });
  </script>
  <script>
    function getGovernorate(elem) {
      var governorate_elem = elem.parentNode.parentNode.getElementsByClassName("option-governorates")[0];
      var city_elem = elem.parentNode.parentNode.getElementsByClassName("option-cityID")[0];
      var idCountry = elem.value;
      var html = '';
      governorate_elem.innerHTML = '';
      city_elem.innerHTML = '';
      $.ajax({
          url: "{{url('AdminPanel/shippingLocations/fetch-governorates')}}",
          type: "POST",
          data: {
          country_id: idCountry,
          _token: '{{csrf_token()}}'
        },
        dataType: 'json',
        success: function (result) {
          html += '<option value="" disabled>--إختار المحافظة--</option>';
          // $('#governorateID').html('<option value="" disabled>--إختار المحافظة--</option>');
          $.each(result.governorates, function (key, value) {
            html += '<<option value="' + value.id + '">' + value.name_ar + '</option>';
            // $("#governorateID").append('<option value="' + value.id + '">' + value.name_ar + '</option>');
          });
          governorate_elem.innerHTML = html;
          city_elem.innerHTML = '<option value="" disabled>--إختار المدينة--</option>';
        }
      });
    }
    function getCity(elem) {
        var city_elem = elem.parentNode.parentNode.getElementsByClassName("option-cityID")[0];
        var governorate_id = elem.value;
        var html = '';
        city_elem.innerHTML = '';
        $.ajax({
        url: "{{url('AdminPanel/shippingLocations/fetch-cities')}}",
        type: "POST",
        data: {
        governorate_id: governorate_id,
        _token: '{{csrf_token()}}'
        },
        dataType: 'json',
        success: function (result) {
        html += '<option value="" disabled>--إختار المدينة--</option>';
        // $('#governorateID').html('<option value="" disabled>--إختار المحافظة--</option>');
        $.each(result.cities, function (key, value) {
        html += '<<option value="' + value.id + '">' + value.name_ar + '</option>';
          // $("#governorateID").append('<option value="' + value.id + '">' + value.name_ar + '</option>');
          });
          city_elem.innerHTML = html;
          }
          });
    }
    
  </script>
@stop
