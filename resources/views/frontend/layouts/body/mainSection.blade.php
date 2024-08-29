<!-- Home slider -->
<section class="container p-0">
    <div class="slide-1 home-slider">
        @for($i = 1; $i <= 4; $i++) @if(getSettingValue('homeSliderImage' . $i) !='' ) <div>
            <div class="home  text-center">
                <img src="{{ getSettingImageLink('homeSliderImage' . $i) }}" alt="" class="bg-img blur-up lazyload">
                <div class="container pt-lg-5">
                    <div class="row justify-content-center text-start ">
                        <div class="col-md-10 pt-lg-5 mt-lg-5" style="padding-top:4rem;">
                            @if (getSettingValue('homeSliderTitle' . $i . '_'.app()->getLocale()) != '')
                            <h2 class="text-start">{{getSettingValue('homeSliderTitle' . $i . '_'.app()->getLocale())}}</h2>
                            @endif
                            @if (getSettingValue('homeSliderButtonTitle' . $i . '_'.app()->getLocale()) != '')
                            <a href="{{ getSettingValue('buttonLink' . $i) }}" class="btn btn-white" style="float:left;">
                                {{getSettingValue('homeSliderButtonTitle' . $i . '_'.app()->getLocale())}}
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @endif
    @endfor
    </div>
</section>



<!-- Home slider end -->


<!-- 
 
 -->