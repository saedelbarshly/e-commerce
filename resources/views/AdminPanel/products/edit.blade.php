@extends('AdminPanel.layouts.master')
@section('content')

<!-- Bordered table start -->
<div class="row" id="table-bordered">
  <div class="col-12">
    {{Form::open(['url'=>route('admin.products.update', $product->id), 'files'=>'true'])}}
    <div class="card">
      <div class="card-body">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="general-tab" data-bs-toggle="tab" href="#general" aria-controls="home"
              role="tab" aria-selected="true">
              <i data-feather="home"></i> {{trans('common.general')}}
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="information-tab" data-bs-toggle="tab" href="#information"
              aria-controls="information" role="tab" aria-selected="false">
              <i data-feather="file-text"></i> {{trans('common.information')}}
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="links-tab" data-bs-toggle="tab" href="#links" aria-controls="links" role="tab"
              aria-selected="false">
              <i data-feather="link"></i> {{trans('common.links')}}
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="specifications-tab" data-bs-toggle="tab" href="#specifications"
              aria-controls="specifications" role="tab" aria-selected="false">
              <i data-feather="figma"></i> {{trans('common.specifications')}}
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="options-tab" data-bs-toggle="tab" href="#options" aria-controls="options" role="tab"
              aria-selected="false">
              <i data-feather="figma"></i> {{trans('common.options')}}
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="discount-tab" data-bs-toggle="tab" href="#discount" aria-controls="discount"
              role="tab" aria-selected="false">
              <i data-feather="percent"></i> {{trans('common.discount')}}
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="specialOffer-tab" data-bs-toggle="tab" href="#specialOffer"
              aria-controls="specialOffer" role="tab" aria-selected="false">
              <i data-feather="briefcase"></i> {{trans('common.specialOffers')}}
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="images-tab" data-bs-toggle="tab" href="#images" aria-controls="images" role="tab"
              aria-selected="false">
              <i data-feather="image"></i> {{trans('common.images')}}
            </a>
          </li>
        </ul>
        <div class="tab-content">
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          <div class="tab-pane active" id="general" aria-labelledby="general-tab" role="tabpanel">
            @include('AdminPanel.products.edit.general')
          </div>
          <div class="tab-pane" id="information" aria-labelledby="information-tab" role="tabpanel">
            @include('AdminPanel.products.edit.information')
          </div>
          <div class="tab-pane" id="links" aria-labelledby="links-tab" role="tabpanel">
            @include('AdminPanel.products.edit.links')
          </div>
          <div class="tab-pane" id="specifications" aria-labelledby="specifications-tab" role="tabpanel">
            @include('AdminPanel.products.edit.specifications')
          </div>
          <div class="tab-pane" id="options" aria-labelledby="options-tab" role="tabpanel">
            @include('AdminPanel.products.edit.options')
          </div>
          <div class="tab-pane" id="discount" aria-labelledby="discount-tab" role="tabpanel">
            @include('AdminPanel.products.edit.discount')
          </div>
          <div class="tab-pane" id="specialOffer" aria-labelledby="specialOffer-tab" role="tabpanel">
            @include('AdminPanel.products.edit.specialOffer')
          </div>
          <div class="tab-pane" id="images" aria-labelledby="images-tab" role="tabpanel">
            @include('AdminPanel.products.edit.images')
          </div>
        </div>
      </div>
      <div class="card-footer">
        <input type="submit" value="{{trans('common.Save changes')}}" class="btn btn-primary">
      </div>
    </div>
    {{Form::close()}}
  </div>
</div>
<!-- Bordered table end -->
@stop
