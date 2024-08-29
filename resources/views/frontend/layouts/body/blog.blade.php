    <div class="wrapper">
        <div class="row">
            <div class="col-12">
                <div class="title2">
                    <h2 class="title-inner2">{{ getSettingValue('blogTitle_'.app()->getLocale()) }}</h2>
                </div>
            </div>
        </div>
        <div class="slide-4">
            @foreach ($blogs as $blog)
            <a href="{{ route('e-commerce.blogDetails', ['blog' => $blog->id,'slug' => $blog['title_' . app()->getLocale()]]) }}">
                <div><img class="blogImg" style="height: 232px; object-fit : cover ;  " src="{{ asset('uploads/blogs/'.$blog->id.'/'.$blog->image) }}"></div>
                @endforeach
        </div>
    </div>
    <section class="service-w-bg pt-0 tools-service mt-3 mb-5">
        <div class="container">
            <div class="service p-0 ">
                <div class="row margin-default">
                    @for ($i = 1; $i <= 4; $i++) @if (getSettingValue('featureTitle' . $i . '_' . app()->getLocale()) != '')
                        <div class="col-xl-3 col-sm-6 service-block mt-0" style="height: 150px; ">
                            <div class="media" style="height: 150px; background-color: white;">
                                <img class="img-fluid blur-up lazyload mx-3" src="{{ getSettingImageLink('featureImage' . $i) }}" alt="" width="60 px" height="60 px">
                                <div class="media-body p-3">
                                    <h4>{{ getSettingValue('featureTitle' . $i . '_' . app()->getLocale()) }}</h4>
                                    <p>{{ getSettingValue('featureDescription' . $i . '_' . app()->getLocale()) }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endfor
                </div>
            </div>
        </div>
    </section>
    <!-- 
    <section class="blog ratio3_2 pt-0 section-b-space slick-default-margin">

    <div class="ratio_square">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="title2">
                        <h2 class="title-inner2">{{ getSettingValue('blogTitle_'.app()->getLocale()) }}</h2>
                    </div>
                </div>
            </div>
            <div class="slide-4 row margin-default">
                @forelse ($blogs as $blog)
                {{-- <div class="col-12 col-md-6 col-lg-4"> --}}
                <div class="col-md-12">
                    <a href="{{ route('e-commerce.blogDetails', ['blog' => $blog->id,'slug' => $blog['title_' . app()->getLocale()]]) }}">
                        <div class="classic-effect">
                            <div>
                                <img alt="" src="{{ asset('uploads/blogs/'.$blog->id.'/'.$blog->image) }}" class="img-fluid blur-up lazyload bg-img">
                                <span></span>
                            </div>
                        </div>
                    </a>
                    <div class="blog-details">
                        <a href="{{ route('e-commerce.blogDetails', ['blog' => $blog->id]) }}">
                            <h4>{{ $blog['title_'.app()->getLocale()] }}</h4>
                        </a>

                        <hr class="style1">
                    </div>
                </div>
                @empty
                <div class="col-md-12">
                    <h2>{{trans('common.nothingToView')}}</h2>
                </div>
                @endforelse
            </div>
        </div>

    </div>
</section>


 -->
    <style>
        @media screen and (max-width : 600px) {
            .blogImg {
                width: 380px !important;
                margin: auto !important;
            }
        }
    </style>