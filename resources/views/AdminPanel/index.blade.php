@extends('AdminPanel.layouts.master')

@section('content')

    <!-- Dashboard Analytics Start -->
    <section id="dashboard-analytics">
        <div class="row">
            <!-- Greetings Card starts -->
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="row match-height">
                    <div class="col-12">
                        <div class="divider mt-0">
                            <div class="divider-text">{{trans('common.ShortCut')}}</div>
                        </div>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <div class="card bg-primary text-white text-center">
                            <div class="card-body">
                                <a href="{{route('admin.products')}}" class="text-white">
                                    {{trans('common.products')}}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <div class="card bg-primary text-white text-center">
                            <div class="card-body">
                                <a href="{{route('admin.categories')}}" class="text-white">
                                    {{trans('common.categories')}}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <div class="card bg-primary text-white text-center">
                            <div class="card-body">
                                <a href="{{route('admin.companies')}}" class="text-white">
                                    {{trans('common.companies')}}
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-xl-3">
                        <div class="card bg-primary text-white text-center">
                            <div class="card-body">
                                <a href="{{route('admin.orders')}}" class="text-white">
                                    {{trans('common.orders')}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Greetings Card ends -->
        </div>
    </section>
    <!-- Dashboard Analytics end -->

@stop

@section('new_style')
    <link rel="stylesheet" type="text/css" href="{{asset('AdminAssets/app-assets/vendors/css/charts/apexcharts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('AdminAssets/app-assets/css-rtl/plugins/charts/chart-apex.css')}}">
@stop

@section('scripts')
    <script src="{{asset('AdminAssets/app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
    <!-- BEGIN: Page JS-->
    <?php /*<script src="{{asset('AdminAssets/app-assets/js/scripts/pages/dashboard-analytics.js')}}"></script>*/?>
    <script src="{{asset('AdminAssets/app-assets/js/scripts/pages/app-invoice-list.js')}}"></script>
    <!-- END: Page JS-->
    <script>
        $(window).on('load', function () {
            var $avgSessionStrokeColor2 = '#ebf0f7';
            var $avgSessionsChart = document.querySelector('#avg-sessions-chart');
            var avgSessionsChartOptions;
            var avgSessionsChart;
            // Average Session Chart
            // ----------------------------------
            avgSessionsChartOptions = {
                chart: {
                    type: 'bar',
                    height: 200,
                    sparkline: { enabled: true },
                    toolbar: { show: false }
                },
                states: {
                    hover: {
                    filter: 'none'
                    }
                },
                colors: [
                    window.colors.solid.primary,
                    window.colors.solid.primary,
                    window.colors.solid.primary,
                    window.colors.solid.primary,
                    window.colors.solid.primary,
                    window.colors.solid.primary
                ],
                series: [
                    {
                        name: 'Sessions',
                        data: [75, 125, 20, 175, 125, 75, 25]
                    }
                ],
                grid: {
                    show: false,
                    padding: {
                        left: 0,
                        right: 0
                    }
                },
                plotOptions: {
                    bar: {
                        columnWidth: '45%',
                        distributed: true,
                        endingShape: 'rounded'
                    }
                },
                tooltip: {
                    x: { show: false }
                },
                xaxis: {
                    type: 'numeric'
                }
            };
            avgSessionsChart = new ApexCharts($avgSessionsChart, avgSessionsChartOptions);
            avgSessionsChart.render();

        });
    </script>
@stop
