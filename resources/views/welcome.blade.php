@extends('frontend.layouts.master')
@section('content')
<!--modal popup start-->
@include('frontend.layouts.common.model')
<!--modal popup end-->
@include('frontend.layouts.body.mainSection')
@include('frontend.layouts.body.topBanner')
@include('frontend.layouts.body.products')
@include('frontend.layouts.body.middleBanner')
@include('frontend.layouts.body.specialProducts')
@include('frontend.layouts.body.blog')
@endsection
