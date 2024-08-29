@extends('frontend.layouts.master')
@section('content')
@include('frontend.layouts.topbar.breadcrumbs')
<!--section start-->
<section class="blog-detail-page section-b-space ratio2_3">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 blog-detail">
        <div class="p-2 mx-2">
          <img src="{{ asset('uploads/blogs/'.$blog->id.'/'.$blog->image) }}" class="img-fluid blur-up lazyload bg-img blogImg " alt="">
        </div>
        <h3 class="mt-3" style="text-align: center">{{ $blog['title_'.$lang] }}</h3>

        {{-- <ul class="post-social">
            <li>25 January 2018</li>
            <li>Posted By : Admin Admin</li>
            <li><i class="fa fa-heart"></i> 5 Hits</li>
            <li><i class="fa fa-comments"></i> 10 Comment</li>
          </ul> --}}
        <p class="mb-3">{!! $blog['description_'.$lang] !!}</p>
      </div>
    </div>

    <!--<div class="row blog-contact">-->
    <!--  <div class="col-sm-12">-->
    <!--    <h2>Leave Your Comment</h2>-->
    <!--    <form class="theme-form">-->
    <!--      <div class="form-row row">-->
    <!--        <div class="col-md-12">-->
    <!--          <label for="name">Name</label>-->
    <!--          <input type="text" class="form-control" id="name" placeholder="Enter Your name" required="">-->
    <!--        </div>-->
    <!--        <div class="col-md-12">-->
    <!--          <label for="email">Email</label>-->
    <!--          <input type="text" class="form-control" id="email" placeholder="Email" required="">-->
    <!--        </div>-->
    <!--        <div class="col-md-12">-->
    <!--          <label for="exampleFormControlTextarea1">Comment</label>-->
    <!--          <textarea class="form-control" placeholder="Write Your Comment" id="exampleFormControlTextarea1"-->
    <!--            rows="6"></textarea>-->
    <!--        </div>-->
    <!--        <div class="col-md-12">-->
    <!--          <button class="btn btn-solid" type="submit">Post Comment</button>-->
    <!--        </div>-->
    <!--      </div>-->
    <!--    </form>-->
    <!--  </div>-->
    <!--</div>-->
  </div>
</section>
<style>
  .blogImg {
    height: 230px;
    object-fit: cover;
  }

  @media screen and (max-width : 767px) {
    .blogImg {
      width: 380px;
      margin: auto;
    }
  }
</style>
<!--Section ends-->

@stop