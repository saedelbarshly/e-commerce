@extends('frontend.layouts.master')
@section('content')
@include('frontend.layouts.topbar.breadcrumbs')
<!--section start-->
<section class="police-section section-b-space mb-5">
  <div class="container mb-4">
    <div class="row">
      <div class="col-sm-12">
        <div class="accordion theme-accordion" id="accordionExample">
          @php
            $row = 1;
          @endphp
          @forelse ($polices as $police)
          <div class="card">
            <div class="card-header" id="headingOne_{{ $police->id }}">
              <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseOne_{{ $police->id }}" aria-expanded="true"
                  aria-controls="collapseOne_{{ $police->id }}">
                  <i data-feather="arrow-down-circle" ></i>
                  {{ trans('common.show') }}
                </button>
              </h5>
            </div>
            <div id="collapseOne_{{ $police->id }}" class="collapse show" aria-labelledby="headingOne_{{ $police->id }}"
              data-bs-parent="#accordionExample">
              <div class="card-body">
                <p>
                  {!! $police['description_'.$lang] !!}
                </p>
              </div>
            </div>
          </div>
          @empty
          <div class="card">
            <div class="card-header" id="headingOne">
              <h5 class="mb-0"><button class="btn btn-link" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  {{ trans('common.NopolicesFound') }}
                </button>
              </h5>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="card-body">
                <p>
                  {{ trans('common.NopolicesFound') }}
                </p>
              </div>
            </div>
          </div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</section>
<!--Section ends-->

@stop
