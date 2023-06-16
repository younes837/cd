@extends('layouts/detachedLayoutMaster')
    @section('title', 'Dashboard')
        @section('vendor-style')
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/charts/apexcharts.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">

        <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/dataTables.bootstrap5.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/tables/datatable/responsive.bootstrap5.min.css')) }}">
        <!-- Vendor css files -->
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/swiper.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
        @endsection
        @section('page-style')
        <!-- Page css files -->
        <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">

        <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/charts/chart-apex.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-invoice-list.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/base/pages/dashboard-ecommerce.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-ecommerce-details.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-number-input.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-wizard.css')) }}">
        @endsection
    


    @section('vendor-script')
        <!-- Vendor js files -->

        <script src="{{ asset(mix('vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/extensions/swiper.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/forms/wizard/bs-stepper.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>

        <script src="{{ asset(mix('vendors/js/charts/apexcharts.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/extensions/moment.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/charts/chart.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>

        
    @endsection
    @section('content')
    <div class="row ">
        
        


        {{-- user Chart --}}
        <div class="col-lg-3 col-sm-6 col-12">
          <div class="card">
            <div class="card-header flex-column align-items-start pb-0">
              <div class="avatar bg-light-primary p-50 m-0">
                <div class="avatar-content">
                  <i data-feather="users" class="font-medium-5"></i>
                </div>
              </div>
              <h2 class="fw-bolder mt-1">{{count(App\Models\User::all())}}</h2>
              <p class="card-text">{{ __('locale.Users') }}</p>
            </div>
            <div class="user-chart"></div>
          </div>
        </div>
        
        {{-- gained chart --}}
        <div class="col-lg-3 col-sm-6 col-12">
            <div class="card">
              <div class="card-header flex-column align-items-start pb-0">
                <div class="avatar bg-light-warning p-50 m-0">
                  <div class="avatar-content">
                    <i data-feather="package" class="font-medium-5"></i>
                  </div>
                </div>
                <h2 class="fw-bolder mt-1">{{count(App\Models\Produit::all())}}</h2>
                <p class="card-text">{{ __('locale.Product') }}</p>
              </div>
              <div class="gained-chart"></div>
            </div>
          </div>
      
          {{-- order chart --}}
        <div class="col-lg-3 col-sm-6 col-12">
          <div class="card">
            <div class="card-header flex-column align-items-start pb-0">
              <div class="avatar bg-light-success p-50 m-0">
                <div class="avatar-content">
                  <i data-feather="shopping-cart" class="font-medium-5"></i>
                </div>
              </div>
              <h2 class="fw-bolder mt-1">{{count(App\Models\Commande::all())}}</h2>
              <p class="card-text">{{ __('locale.Orderes Received') }}</p>
            </div>
            <div class="order-chart"></div>
          </div>
        </div>
  
        {{-- product chart --}}
        <div class="col-lg-3 col-sm-6 col-12">
          <div class="card">
            <div class="card-header flex-column align-items-start pb-0">
              <div class="avatar bg-light-info p-50 m-0">
                <div class="avatar-content">
                  <i data-feather="truck" class="font-medium-5"></i>
                </div>
              </div>
              <h2 class="fw-bolder mt-1">{{count(App\Models\ligneCommande::all())}}</h2>
              <p class="card-text">{{ __('locale.Ordered Product') }}</p>
            </div>
            <div class="product-chart"></div>
          </div>
        </div>
 <!-- Orders Chart Card ends -->
      </div>
     
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header justify-content-between">
              <div>
                <h4 class="card-title">Statistics</h4>
                {{-- <span class="card-subtitle text-muted">Commercial networks and enterprises</span> --}}
              </div>
              <div class="d-flex justify-content-end">
                <div class="mx-1 form-group">
                  <label for="" class="">Step</label>
                    <input type="number" class="form-control" id="step" placeholder="Step" value="400">
                </div>
                <div class="form-group">
                    <label for="">Max</label> 
                    <input type="number" class="form-control"  id="max" placeholder="Max" value="4000">
                </div>
                
                
              </div>
            </div>
            <div class="card-body">
              <canvas class="line-chart-ex chartjs" data-height="450"></canvas>
            </div>
          </div>
        </div>
      </div>
      <div class="col-xl-12 col-12">
        <div class="card">
          <div
            class="
              card-header
              d-flex
              justify-content-between
              align-items-sm-center align-items-start
              flex-sm-row flex-column
            "
          >
            <div class="header-left">
              <h4 class="card-title">Categories</h4>
            </div>
            <div class="header-right d-flex align-items-center mt-sm-0 mt-1">
             <span class="badge rounded-pill bg-success">{{count(App\Models\Produit::all())}} {{ __('locale.Product') }}</span>
            </div>
          </div>
          <div class="card-body">
            <canvas class="bar-chart-ex chartjs" data-height="400"></canvas>
          </div>
        </div>
      </div>
    @endsection
    @section('page-script')
    <!-- Page js files -->
    <script>
    var $gainedChart = document.querySelector('.gained-chart');
    var gainedChart;
    var gainedChartOptions;
    gainedChartOptions = {
        chart: {
        height: 100,
        type: 'area',
        toolbar: {
            show: false
        },
        sparkline: {
            enabled: true
        },
        grid: {
            show: false,
            padding: {
            left: 0,
            right: 0
            }
        }
        },
        colors: [window.colors.solid.warning],
        dataLabels: {
        enabled: false
        },
        stroke: {
        curve: 'smooth',
        width: 2.5
        },
        fill: {
        type: 'gradient',
        gradient: {
            shadeIntensity: 0.2,
            opacityFrom: 0.1,
            opacityTo: 0.5,
            stops: [0, 30, 70]
        }
        },
        series: [
        {
            name: 'Subscribers',
            data: [55, 50, 37, 43, 53, 60, 55]
        }
        ],
        xaxis: {
        labels: {
            show: false
        },
        axisBorder: {
            show: false
        }
        },
        yaxis: [
        {
            y: 0,
            offsetX: 0,
            offsetY: 0,
            padding: { left: 0, right: 0 }
        }
        ],
        tooltip: {
        x: { show: false }
        }
    };
    gainedChart = new ApexCharts($gainedChart, gainedChartOptions);
    gainedChart.render();

    var $productChart = document.querySelector('.product-chart');
    var productChart;
    var productChartOptions;
    productChartOptions = {
        chart: {
        height: 100,
        type: 'area',
        toolbar: {
            show: false
        },
        sparkline: {
            enabled: true
        },
        grid: {
            show: false,
            padding: {
            left: 0,
            right: 0
            }
        }
        },
        colors: [window.colors.solid.info],
        dataLabels: {
        enabled: false
        },
        stroke: {
        curve: 'smooth',
        width: 2.5
        },
        fill: {
        type: 'gradient',
        gradient: {
            shadeIntensity: 0.9,
            opacityFrom: 0.7,
            opacityTo: 0.5,
            stops: [0, 80, 100]
        }
        },
        series: [
        {
            name: 'Subscribers',
            data: [55, 40, 36, 52, 38, 60, 55]
        }
        ],
        xaxis: {
        labels: {
            show: false
        },
        axisBorder: {
            show: false
        }
        },
        yaxis: [
        {
            y: 0,
            offsetX: 0,
            offsetY: 0,
            padding: { left: 0, right: 0 }
        }
        ],
        tooltip: {
        x: { show: false }
        }
    };
    productChart = new ApexCharts($productChart, productChartOptions);
    productChart.render();

    var $orderChart = document.querySelector('.order-chart');
    var orderChart;
    var orderChartOptions;
    orderChartOptions = {
        chart: {
        height: 100,
        type: 'area',
        toolbar: {
            show: false
        },
        sparkline: {
            enabled: true
        },
        grid: {
            show: false,
            padding: {
            left: 0,
            right: 0
            }
        }
        },
        colors: [window.colors.solid.success],
        dataLabels: {
        enabled: false
        },
        stroke: {
        curve: 'smooth',
        width: 2.5
        },
        fill: {
        type: 'gradient',
        gradient: {
            shadeIntensity: 0.9,
            opacityFrom: 0.7,
            opacityTo: 0.5,
            stops: [0, 80, 100]
        }
        },
        series: [
        {
            name: 'Subscribers',
            data: [55, 40, 36, 52, 38, 60, 55]
        }
        ],
        xaxis: {
        labels: {
            show: false
        },
        axisBorder: {
            show: false
        }
        },
        yaxis: [
        {
            y: 0,
            offsetX: 0,
            offsetY: 0,
            padding: { left: 0, right: 0 }
        }
        ],
        tooltip: {
        x: { show: false }
        }
    };
    orderChart = new ApexCharts($orderChart, orderChartOptions);
    orderChart.render();

    var $userChart = document.querySelector('.user-chart');
    var userChart;
    var userChartOptions;
    userChartOptions = {
        chart: {
        height: 100,
        type: 'area',
        toolbar: {
            show: false
        },
        sparkline: {
            enabled: true
        },
        grid: {
            show: false,
            padding: {
            left: 0,
            right: 0
            }
        }
        },
        colors: [window.colors.solid.primary],
        dataLabels: {
        enabled: false
        },
        stroke: {
        curve: 'smooth',
        width: 2.5
        },
        fill: {
        type: 'gradient',
        gradient: {
            shadeIntensity: 0.9,
            opacityFrom: 0.7,
            opacityTo: 0.5,
            stops: [0, 80, 100]
        }
        },
        series: [
        {
            name: 'Subscribers',
            data: [28, 40, 36, 52, 38, 60, 55]
        }
        ],
        xaxis: {
        labels: {
            show: false
        },
        axisBorder: {
            show: false
        }
        },
        yaxis: [
        {
            y: 0,
            offsetX: 0,
            offsetY: 0,
            padding: { left: 0, right: 0 }
        }
        ],
        tooltip: {
        x: { show: false }
        }
    };
    userChart = new ApexCharts($userChart, userChartOptions);
    userChart.render();



    </script>
    <script src="{{ asset(mix('js/scripts/pages/app-ecommerce-details.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-number-input.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-wizard.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/pages/app-invoice-list.js')) }}"></script>
  {{-- <script src="{{ asset(mix('js/scripts/charts/chart-chartjs.js')) }}"></script> --}}
<script>
    chart(400,4000)
    var step=$('#step').val()
    var max=$('#max').val()
    $('#step').on('change',function () {
        step=$(this).val()
        chart(step,max)
    })
    $('#max').on('change',function () {
        max=$(this).val()
        chart(step,max)
    })
    function chart(step,max) {
        
   
    var primaryColorShade = '#836AF9',
    yellowColor = '#ffe800',
    successColorShade = '#28dac6',
    warningColorShade = '#ffe802',
    warningLightColor = '#FDAC34',
    infoColorShade = '#299AFF',
    greyColor = '#4F5D70',
    blueColor = '#2c9aff',
    blueLightColor = '#84D0FF',
    greyLightColor = '#EDF1F4',
    tooltipShadow = 'rgba(0, 0, 0, 0.25)',
    lineChartPrimary = '#666ee8',
    lineChartDanger = '#ff4961',
    labelColor = '#6e6b7b',
    grid_line_color = 'rgba(200, 200, 200, 0.2)';
    var chartWrapper = $('.chartjs');
    if (chartWrapper.length) {
    chartWrapper.each(function () {
      $(this).wrap($('<div style="height:' + this.getAttribute('data-height') + 'px"></div>'));
    });
  }
      var lineChartEx = $('.line-chart-ex')
      if (lineChartEx.length) {
    var lineExample = new Chart(lineChartEx, {
      type: 'line',
      plugins: [
        // to add spacing between legends and chart
        {
          beforeInit: function (chart) {
            chart.legend.afterFit = function () {
              this.height += 20;
            };
          }
        }
      ],
      options: {
        responsive: true,
        maintainAspectRatio: false,
        backgroundColor: false,
        hover: {
          mode: 'label'
        },
        tooltips: {
          // Updated default tooltip UI
          shadowOffsetX: 1,
          shadowOffsetY: 1,
          shadowBlur: 8,
          shadowColor: tooltipShadow,
          backgroundColor: window.colors.solid.white,
          titleFontColor: window.colors.solid.black,
          bodyFontColor: window.colors.solid.black
        },
        layout: {
          padding: {
            top: -15,
            bottom: -25,
            left: -15
          }
        },
        scales: {
          xAxes: [
            {
              display: true,
              scaleLabel: {
                display: true
              },
              gridLines: {
                display: true,
                color: grid_line_color,
                zeroLineColor: grid_line_color
              },
              ticks: {
                fontColor: labelColor
              }
            }
          ],
          yAxes: [
            {
              display: true,
              scaleLabel: {
                display: true
              },
              ticks: {
                stepSize: +step,
                min: 0,
                max: +max,
                fontColor: labelColor
              },
              gridLines: {
                display: true,
                color: grid_line_color,
                zeroLineColor: grid_line_color
              }
            }
          ]
        },
        legend: {
          position: 'top',
          align: 'start',
          labels: {
            usePointStyle: true,
            padding: 25,
            boxWidth: 9
          }
        }
      },
      data: {
        labels: {!! json_encode($months) !!},
        datasets: [
          {
            data: {!! json_encode($sales) !!},
            label: 'Sales',
            borderColor: lineChartDanger,
            lineTension: 0.5,
            pointStyle: 'circle',
            backgroundColor: lineChartDanger,
            fill: false,
            pointRadius: 1,
            pointHoverRadius: 5,
            pointHoverBorderWidth: 5,
            pointBorderColor: 'transparent',
            pointHoverBorderColor: window.colors.solid.white,
            pointHoverBackgroundColor: lineChartDanger,
            pointShadowOffsetX: 1,
            pointShadowOffsetY: 1,
            pointShadowBlur: 5,
            pointShadowColor: tooltipShadow
          },
          {
            data: {!! json_encode($quantite) !!},
            label: 'Sold Product',
            borderColor: lineChartPrimary,
            lineTension: 0.5,
            pointStyle: 'circle',
            backgroundColor: lineChartPrimary,
            fill: false,
            pointRadius: 1,
            pointHoverRadius: 5,
            pointHoverBorderWidth: 5,
            pointBorderColor: 'transparent',
            pointHoverBorderColor: window.colors.solid.white,
            pointHoverBackgroundColor: lineChartPrimary,
            pointShadowOffsetX: 1,
            pointShadowOffsetY: 1,
            pointShadowBlur: 5,
            pointShadowColor: tooltipShadow
          },
          {
            data: {!! json_encode($commande_count) !!},
            label: 'Orders',
            borderColor: warningColorShade,
            lineTension: 0.5,
            pointStyle: 'circle',
            backgroundColor: warningColorShade,
            fill: false,
            pointRadius: 1,
            pointHoverRadius: 5,
            pointHoverBorderWidth: 5,
            pointBorderColor: 'transparent',
            pointHoverBorderColor: window.colors.solid.white,
            pointHoverBackgroundColor: warningColorShade,
            pointShadowOffsetX: 1,
            pointShadowOffsetY: 1,
            pointShadowBlur: 5,
            pointShadowColor: tooltipShadow
          }
        ]
      }
    });
  }}
</script> 
<script>
    var  barChartEx = $('.bar-chart-ex')
   var primaryColorShade = '#836AF9',
    yellowColor = '#ffe800',
    successColorShade = '#28dac6',
    warningColorShade = '#ffe802',
    warningLightColor = '#FDAC34',
    infoColorShade = '#299AFF',
    greyColor = '#4F5D70',
    blueColor = '#2c9aff',
    blueLightColor = '#84D0FF',
    greyLightColor = '#EDF1F4',
    tooltipShadow = 'rgba(0, 0, 0, 0.25)',
    lineChartPrimary = '#666ee8',
    lineChartDanger = '#ff4961',
    labelColor = '#6e6b7b',
    grid_line_color = 'rgba(200, 200, 200, 0.2)';
  if (barChartEx.length) {
    var barChartExample = new Chart(barChartEx, {
      type: 'bar',
      options: {
        elements: {
          rectangle: {
            borderWidth: 2,
            borderSkipped: 'bottom'
          }
        },
        responsive: true,
        maintainAspectRatio: false,
        responsiveAnimationDuration: 500,
        legend: {
          display: false
        },
        tooltips: {
          // Updated default tooltip UI
          shadowOffsetX: 1,
          shadowOffsetY: 1,
          shadowBlur: 8,
          shadowColor: tooltipShadow,
          backgroundColor: window.colors.solid.white,
          titleFontColor: window.colors.solid.black,
          bodyFontColor: window.colors.solid.black
        },
        scales: {
          xAxes: [
            {
              display: true,
              gridLines: {
                display: true,
                color: grid_line_color,
                zeroLineColor: grid_line_color
              },
              scaleLabel: {
                display: false
              },
              ticks: {
                fontColor: labelColor
              }
            }
          ],
          yAxes: [
            {
              display: true,
              gridLines: {
                color: grid_line_color,
                zeroLineColor: grid_line_color
              },
              ticks: {
                stepSize: 5,
                min: 0,
                max: 30,
                fontColor: labelColor
              }
            }
          ]
        }
      },
      data: {
        labels: {!! json_encode($labels) !!},
        datasets: [
          {
            data: {!! json_encode($data) !!},
            barThickness: 15,
            backgroundColor: successColorShade,
            borderColor: 'transparent'
          }
        ]
      }
    });
  }

</script>
    @endsection