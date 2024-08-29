@extends('frontend.layouts.master')
@section("content")
@include('frontend.layouts.topbar.breadcrumbs')
<!-- START:: CHANGE PASSWORD FORM -->
<div class="reset_password">
  <div class="container d-flex flex-column justify-content-center align-items-center">
    <div class="form_wraper col-12 col-md-6 wow fadeInLeftBig" data-wow-duration="1.5s" data-wow-delay="0.3s">
      <form action="{{ route('account.verify') }}" method="post">
        @csrf
        @if (session()->has('success'))
        <div class="alert alert-success {{ App::getLocale() == 'ar' ? 'text-right':'text-left' }}">
          {{ session()->get("success") }}
        </div>
        @endif
        @if (session()->has('error'))
        <div class="alert alert-danger">
          {{ session()->get("error") }}
        </div>
        @endif

        <div class="form-group my-4">
          <label for="otp"> {{ trans("common.otp") }} </label>
          <input type="text" class="form-control" id="otp" name="otp" required>
          @if($errors->has('otp'))
          <span class="text-danger" style="text-align : {{ isRtl()? " right" : "left" }}" role="alert">
            <b>{{ $errors->first('otp') }}</b>
          </span>
          @endif
        </div>
        <div class="my-2">
          <button type="submit" class="btn btn-primary"> {{ trans("common.submit") }} </button>
        </div>

      </form>

      <button type="button" id="resent" class=" btn btn-success" onclick="resentSmsCode()">{{
        __('common.resent_code')}}</button>
      <p id="demo"></p>
    </div>
  </div>
</div>
<!-- END:: CHANGE PASSWORD FORM -->

@stop

@push('scripts')
<script>
  function resentSmsCode(){
              const userID = "{{$user->id}}";
               var timeleft = 120;
              $.ajax({
                type:"POST",
                url:"{{route('resent.verify')}}",
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                data: {'id':userID},
                success: function (data) {

                   var countdownTimer = setInterval(() => {
                          timeleft--;

                        if (timeleft <= 0) {

                                clearInterval(countdownTimer);
                                resolve(true);
                             document.getElementById("resent").disabled =false;
                        }else{
                            document.getElementById("demo").innerHTML =  " {{__('app.resent_agian_code') ." ". __('app.seconds') }}" +" "+ timeleft;
                             document.getElementById("resent").disabled =true;
                        }


                    },1000);


                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }


              });
      }

</script>
@endpush
