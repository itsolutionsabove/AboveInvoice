<div class="container-xl">
    <div class="row row-cards">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Dashboard</h4>
                </div>
{{--                <div class="card-body">--}}
{{--                    <div class="row">--}}
{{--                        <!-- Products Chart Column -->--}}
{{--                        <div class="col-lg-6 col-sm-12 mb-3">--}}
{{--                            <div id="mostViewedProductsChart" style="width: 100%; height: 100%;"></div>--}}
{{--                        </div>--}}

{{--                        <!-- Categories Chart Column -->--}}
{{--                        <div class="col-lg-6 col-sm-12 mb-3">--}}
{{--                            <div id="mostViewedCategoriesChart" style="width: 100%; height: 100%;"></div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
            </div>
        </div>
    </div>
</div>


{{--<script wire:ignore>--}}
{{--    // Data for Most Viewed Products--}}
{{--    var productNames = @json($mostViewedProducts->pluck('name'));--}}
{{--    var productViews = @json($mostViewedProducts->pluck('views'));--}}

{{--    var optionsProducts = {--}}
{{--        chart: {--}}
{{--            type: 'bar',--}}
{{--            height: 350,--}}
{{--        },--}}
{{--        series: [{--}}
{{--            name: 'Views',--}}
{{--            data: productViews--}}
{{--        }],--}}
{{--        xaxis: {--}}
{{--            categories: productNames--}}
{{--        },--}}
{{--        title: {--}}
{{--            text: 'Top 5 Most Viewed Products'--}}
{{--        },--}}
{{--        colors: ['#35493B']--}}
{{--    };--}}

{{--    var productsChart = new ApexCharts(document.querySelector("#mostViewedProductsChart"), optionsProducts);--}}
{{--    productsChart.render();--}}

{{--    // Data for Most Viewed Categories--}}
{{--    var categoryNames = @json($mostViewedCategories->pluck('name'));--}}
{{--    var categoryViews = @json($mostViewedCategories->pluck('views'));--}}

{{--    var optionsCategories = {--}}
{{--        chart: {--}}
{{--            type: 'bar',--}}
{{--            height: 350,--}}
{{--        },--}}
{{--        series: [{--}}
{{--            name: 'Views',--}}
{{--            data: categoryViews--}}
{{--        }],--}}
{{--        xaxis: {--}}
{{--            categories: categoryNames--}}
{{--        },--}}
{{--        title: {--}}
{{--            text: 'Top 5 Most Viewed Categories'--}}
{{--        },--}}
{{--        colors: ['#35493B']--}}
{{--    };--}}

{{--    var categoriesChart = new ApexCharts(document.querySelector("#mostViewedCategoriesChart"), optionsCategories);--}}
{{--    categoriesChart.render();--}}
{{--</script>--}}
