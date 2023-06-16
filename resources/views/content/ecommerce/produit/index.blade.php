@extends('layouts/detachedLayoutMaster')
    @section('title', 'Produit')
        @section('vendor-style')
        <!-- Vendor css files -->
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/swiper.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
        <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">    
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">
        @endsection
        @section('page-style')
        <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-ecommerce.css')) }}">
        <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-ecommerce-details.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-number-input.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <style>
    .avatar-xxs{height:1.5rem;width:1.5rem}.avatar-xs{height:2rem;width:2rem}.avatar-sm{height:3rem;width:4rem}.avatar-md{height:4.5rem;width:4.5rem}.avatar-lg{height:6rem;width:6rem}.avatar-xl{height:7.5rem;width:7.5rem}.avatar-title{align-items:center;background-color:var(--tb-primary-text-emphasis);color:#fff;display:flex;font-weight:var(--tb-font-weight-medium);height:100%;justify-content:center;width:100%}.avatar-group{padding-left:12px;display:flex;flex-wrap:wrap}.avatar-group .avatar-group-item{margin-left:-12px;border:2px solid var(--tb-border-color);border-radius:50%;transition:all .2s}.avatar-group .avatar-group-item:hover{position:relative;transform:translateY(-2px);z-index:1}
</style>
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
        @endsection



    @section('vendor-script')
        <!-- Vendor js files -->
        <script src="{{ asset(mix('vendors/js/charts/chart.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/swiper.min.js')) }}"></script>
    @endsection
    @section('content')
        <!-- Hoverable rows start -->
        <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="card">
              <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                  <h3 class="fw-bolder mb-75">{{count(App\Models\Produit::all())}}</h3>
                  <span>{{ __('locale.Total Products') }}</span>
                </div>
                <div class="avatar bg-light-primary p-50">
                  <span class="avatar-content">
                    <i data-feather="package" class="font-medium-4"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6">
            <div class="card">
              <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                  <h3 class="fw-bolder mb-75">{{count(App\Models\Produit::where('stock',0)->get())}}</h3>
                  <span>{{ __('locale.Products Out of Stock') }}</span>
                </div>
                <div class="avatar bg-light-danger p-50">
                  <span class="avatar-content">
                    <i data-feather="x" class="font-medium-4"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6">
            <div class="card">
              <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                  <h3 class="fw-bolder mb-75">{{count(App\Models\Produit::whereNotNull('promo')->get())}}</h3>
                  <span>{{ __('locale.Discounted Products') }}</span>
                </div>
                <div class="avatar bg-light-success p-50">
                  <span class="avatar-content">
                    <i data-feather="percent" class="font-medium-4"></i>
                  </span>
                </div>
              </div>
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
               <span class="badge rounded-pill bg-success">{{count(App\Models\Produit::all())}} {{ __('locale.Products') }}</span>
              </div>
            </div>
            <div class="card-body">
              <canvas class="bar-chart-ex chartjs" data-height="400"></canvas>
            </div>
          </div>
        </div>
<div class="row" id="table-hover-row">
    @if ($errors->any())
        <input type="hidden" id="error" value="{{ $errors->first() }}">
         <script>
             $(document).ready(function () {
                Swal.fire('Error',$('#error').val(),'error',{
                  confirmButtonClass: 'btn btn-primary',
                  buttonsStyling: !1
                });
            });
          </script>

    @endif
    @if(Session::has('succes'))
                <script>
                    $(document).ready(function () {
                    Swal.fire('Succes!','product Added Successfully!','success',{

                confirmButtonClass: 'btn btn-primary',
                buttonsStyling: !1
                });
                });
                </script>
    @endif
    @if(Session::has('update'))
                <script>
                $(document).ready(function () {
                Swal.fire('Succes!','User Updated Successfully!','success',{

                confirmButtonClass: 'btn btn-primary',
                buttonsStyling: !1
            });
            });
                </script>
    @endif
    @if(Session::has('delete'))
                    <script>
                    $(document).ready(function () {
                    Swal.fire('Succes!','User Deleted Successfully!','success',{

                    confirmButtonClass: 'btn btn-primary',
                    buttonsStyling: !1
                });
                });
                    </script>
    @endif
    <div class="col-12">
      <div class="card">


        <div class="mb-2 row mt-1">
            <!-- Button trigger modal -->
            <div class="col-1 mb-1"></div>
            <div class="col-4 col-xs-6 mb-1 ">
              <select class="form-select" name="filter_categorie"   id="select-categorie">
                <option value="all">{{ __('locale.all') }}</option>
                @foreach ($categories as $categorie)
                  <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                @endforeach
              </select> 
            </div>
            <div class="col-4 col-xs-6 mb-1">
              <input type="text" id="search" class="form-control" placeholder="{{ __('locale.Search') }}">
            
            </div>
            <div class="col-3 col-xs-6 mb-1">
              <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#large">
                {{ __('locale.Add Product') }}
              </button>
            </div>
        </div>
          <div>
            <!-- Modal -->
            <div
              class="modal fade text-start"
              id="large"
              tabindex="-1"
              aria-labelledby="myModalLabel17"
              aria-hidden="true"
            >
              <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                  <div class="modal-header">

                    <h4 class="modal-title" id="myModalLabel17">{{ __('locale.Add Product') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form class="form" method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
                        @csrf
                      <div class="row">
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="first-name-column">{{ __('locale.Name') }}</label>
                            <input
                              type="text"
                              id="first-name-column"
                              class="form-control"
                              placeholder="Name"
                              name="libelle"
                            />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="last-name-column">{{ __('locale.Picture') }}</label>
                            <input
                              type="file"
                              id="last-name-column"
                              class="form-control"
                              {{-- placeholder="inserer une photo" --}}
                              name="photo"
                            />
                          </div>
                        </div>
                        <div class="col-md-12 col-12">
                          <div class="form-group">
                            <label for="city-column">Description</label>
                            <input type="text" id="descreption-column" class="form-control" placeholder="Description" name="description" />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="country-floating">Stock</label>
                            <input
                              type="number"
                              id="stock-floating"
                              class="form-control"
                              name="stock"
                              placeholder="Stock"
                            />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="company-column">{{ __('locale.Rating') }}</label>
                            <input
                              type="number"
                              id="rating-column"
                              class="form-control"
                              max=5
                              name="rating"
                              placeholder="rating"
                            />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="email-id-column">{{ __('locale.Price') }}</label>
                            <input
                              type="number"
                              id="price-id-column"
                              class="form-control"
                              name="price"
                              placeholder="price"
                            />
                          </div>
                        </div>
                      <div class="col-md-6 col-12">
                        <label class="form-label" for="selectDefault">Categorie</label>
                        <select class="form-select " name="categorie" id="selectDefault">
                            <option value="">Categorie</option>
                                    @foreach($categories as $categorie)
                                    <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                                    @endforeach
                            </select>
                    </div>
                    <div class="col-md-6 col-12">
                        <label class="form-label" for="selectDefault">Propriete</label>
                        <select class="form-select " name="propriete" id="selectDefault">
                            <option value="">Propriete</option>
                                    @foreach($proprietes as $propriete)
                                    <option value="{{$propriete->id}}">{{$propriete->libelle}}</option>
                                    @endforeach
                            </select>
                    </div>
                    <div class="col-md-6 col-12">
                        <label class="form-label" for="selectDefault">{{ __('locale.Brand') }}</label>
                        <select class="form-select " name="brand" id="selectDefault">
                            <option value="">Brand</option>
                                    @foreach($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                            </select>
                    </div>
                    <div class="col-md-12 col-12">
                        <label class="form-label" for="selectDefault">{{ __('locale.Discount') }} (%)</label>
                        <input
                              type="number"
                              id="price-id-column"
                              class="form-control"
                              name="promo"
                              placeholder="Discount"
                            />
                            <span class="text-secondary">{{ __('locale.Left this field blank in case there is no discount') }}</span>
                    </div>

                    </div>
                      <div class="modal-footer">
                        <button type="submit" rippleEffect class="btn btn-primary mr-1">Submit</button>
                        {{-- <button type="reset" rippleEffect class="btn btn-outline-secondary">Reset</button> --}}
                      </div>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <!-- kkkkkkkkkkk -->
        <div class="table-responsive" id="table-content">
          @include('content/ecommerce/produit/index-content')
        </div>
      </div>
    </div>

    <input type="hidden" value="1" id="hidden_page">


</div>
    @endsection
    @section('page-script')
<script>
  $('#search').on('keyup',function () {
    value=$(this).val()
    page=$('#hidden_page').val()
    categorie=$('#select-categorie').val()

    search(value,page,categorie)
  })
$('#select-categorie').on('change',function () {
  categorie=$(this).val()
  page=$('#hidden_page').val()
  var query=$('#search').val();
  search(query,page,categorie)
  console.log(categorie);
})

  $(document).on('click', '.pagination a', function(event){
        event.preventDefault(); 
        var page = $(this).attr('href').split('page=')[1];
        $('#hidden_page').val(page);
        var query=$('#search').val();
        categorie=$('#select-categorie').val()

        search(query,page,categorie)

      })
  function search(value,page,categorie){
   $.ajax({

    url:"/filter_categorie?search="+value+"&page="+page+"&categorie="+categorie,
    success:function(data)
  {
    console.log(data);
    $("#table-content").html(data)
    feather.replace();
   
  }
   })
  }

 
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
    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/pages/app-ecommerce-details.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-number-input.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>

    @endsection


