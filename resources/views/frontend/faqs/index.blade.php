@extends('frontend.layouts.master')
@section('content')
@include('frontend.layouts.topbar.breadcrumbs')
  <!--section start-->
 <section class="faq-section section-b-space mb-5">
  <div class="container mb-4">
    <div class="row">
      <div class="col-sm-12">
        <div class="accordion theme-accordion" id="accordionExample">
          @forelse ($FAQs as $faq)
          <div class="card">
            <div class="card-header" id="headingOne_{{ $faq->id }}">
              <h5 class="mb-0">
                <button class="btn btn-link" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseOne_{{ $faq->id }}" aria-expanded="true" aria-controls="collapseOne_{{ $faq->id }}">
                  {{ $faq['question_'.$lang] }}
                </button>
              </h5>
            </div>
            <div id="collapseOne_{{ $faq->id }}" class="collapse show" aria-labelledby="headingOne_{{ $faq->id }}" data-bs-parent="#accordionExample">
              <div class="card-body">
                <p>
                  {!! $faq['answer_'.$lang] !!}
                </p>
              </div>
            </div>
          </div>
          @empty
          <div class="card">
            <div class="card-header" id="headingOne">
              <h5 class="mb-0"><button class="btn btn-link" type="button" data-bs-toggle="collapse"
                  data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                  {{ trans('common.NoFAQsFound') }}
                </button>
              </h5>
            </div>
            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="card-body">
                <p>
                  {{ trans('common.NoFAQsFound') }}
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
