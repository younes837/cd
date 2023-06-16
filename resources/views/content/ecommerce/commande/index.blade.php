@extends('layouts/detachedLayoutMaster')
    @section('title', 'Commande')
        @section('vendor-style')
        <!-- Vendor css files -->
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/swiper.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
        <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
            <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">
        @endsection
        @section('page-style')
        <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-ecommerce-details.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-number-input.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">

        @endsection



    @section('vendor-script')
        <!-- Vendor js files -->
        <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/swiper.min.js')) }}"></script>
    @endsection
    @section('content')
    <div class="col-xl-12 col-md-12 col-12">
      <div class="card card-statistics">
        <div class="card-header">
          <h4 class="card-title">Statistics</h4>
          <div class="d-flex align-items-center">
            <p class="card-text font-small-2 me-25 mb-0">Updated 1 week ago</p>
          </div>
        </div>
        <div class="card-body statistics-body">
          <div class="row">
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                  <div class="avatar-content">
                    <i data-feather="trending-up" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                  @php
                  $count= App\Models\ligneCommande::join('commande', 'commande.id', '=', 'produit_commande.commande_id')
                    ->where('commande.etat_id', '=', 2)
                    ->get()
                  @endphp
                  <h4 class="fw-bolder mb-0">{{
                count($count)
                    }}</h4>
                  <p class="card-text font-small-3 mb-0">Sales</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-info me-2">
                  <div class="avatar-content">
                    <i data-feather="user" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">{{$userCounts}}</h4>
                  <p class="card-text font-small-3 mb-0">{{ __('locale.Customers') }}</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-danger me-2">
                  <div class="avatar-content">
                    <i data-feather="box" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">{{count($products)}}</h4>
                  <p class="card-text font-small-3 mb-0">{{ __('locale.Products') }}</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-success me-2">
                  <div class="avatar-content">
                    <i data-feather="dollar-sign" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">${{App\Models\Commande::selectRaw('SUM(total) as total_sum')->where('etat_id',2)
                    ->get()
                    ->pluck('total_sum')
                    ->first();}}</h4>
                  <p class="card-text font-small-3 mb-0">Revenue</p>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-2 d-flex justify-content-right">
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-primary me-2">
                  <div class="avatar-content">
                    <i data-feather="box" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                  @php
                  $count= App\Models\Commande::all()
                  @endphp
                  <h4 class="fw-bolder mb-0">{{
                count($count)
                    }}</h4>
                  <p class="card-text font-small-3 mb-0">{{ __('locale.Total Orderes') }}</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-xl-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-info me-2">
                  <div class="avatar-content">
                    <i data-feather="clock" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">{{count(App\Models\Commande::where('etat_id',1)->get())}}</h4>
                  <p class="card-text font-small-3 mb-0">{{ __('locale.Pending') }}</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-success me-2">
                  <div class="avatar-content">
                    <i data-feather="check" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">{{count(App\Models\Commande::where('etat_id',2)->get())}}</h4>
                  <p class="card-text font-small-3 mb-0">{{ __('locale.Confirmed') }}</p>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12 mb-2 mb-sm-0">
              <div class="d-flex flex-row">
                <div class="avatar bg-light-danger me-2">
                  <div class="avatar-content">
                    <i data-feather="x" class="avatar-icon"></i>
                  </div>
                </div>
                <div class="my-auto">
                  <h4 class="fw-bolder mb-0">{{count(App\Models\Commande::where('etat_id',3)->get())}}</h4>
                  <p class="card-text font-small-3 mb-0">{{ __('locale.Rejected') }}</p>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div>
    </div>




<div class="card ">
  {{-- <div class="row">
    <div class="col-xl-2 col-md-6 col-12">sdfs </div>
    <div class="input-group input-group-merge col-xl-3 col-md-6 col-12">
      <span class="input-group-text" id="basic-addon-search2"><i data-feather="search"></i></span>
      <input 
        type="text"
        class="form-control"
        placeholder="Search..."
        aria-label="Search..."
        aria-describedby="basic-addon-search2"
      />
    </div>
     <div class="col-xl-7 col-md-6 col-12">sdfsd</div>
  </div> --}}
  <div class="mb-2 row mt-1">
    <!-- Button trigger modal -->
    <div class="col-2"></div>
    <div class="col-4 "> <div class="input-group input-group-merge mb-2">
   
    <span class="input-group-text" id="basic-addon-search2"><i data-feather="search"></i></span>
    <input
      type="text"
      class="form-control"
      id="search"
      placeholder="{{ __('locale.Search') }}..."
      aria-label="Search..."
      aria-describedby="basic-addon-search2"
    />
  </div> </div>
    <div class="col-4 mb-2 ">
      <form action="" method="GET">
        <select name="" id="status" class="form-control">
          <option value="all">{{ __('locale.all') }}</option>
          <option value="1">{{ __('locale.Pending') }}</option>
          <option value="2">{{ __('locale.Confimed') }}</option>
          <option value="3">{{ __('locale.Rejected') }}</option>
        </select>
        
      </form>
    </div>
    <div class="col-2 mb-2 d-flex justify-content-start">
  
  </div>
</div>



<div id="commande-content">


  @include('content/ecommerce/commande/commande-content')
</div>
    

    
    
</div>
<input type="hidden" id="hidden_page" value="1">
<input type="hidden" id="hidden_status">

<script>
  $(document).on('click', '.pagination a', function(event){
        event.preventDefault(); 
        var page = $(this).attr('href').split('page=')[1];
        $('#hidden_page').val(page);
        var query=$('#search').val();
        var status=$('#status').val()
       
        search_data(page,query,status)

      })
      $('#search').on('keyup',function(){
        var page=$('#hidden_page').val();
        var query = $(this).val();
        var status=$('#status').val()


        search_data(page,query,status)

      })
      $('#status').on('change',function(){
        var status=$('#status').val()
        var page=$('#hidden_page').val();
        var query=$('#search').val();
 
        search_data(page,query,status)
      })
      function search_data(page,query,status){
        $.ajax({
  url:"/search_commande?page="+page+"&query="+query+"&status="+status,
  success:function(data)
  {
    console.log(data);
    $("#commande-content").html(data)
    feather.replace();

   
  }
 })

      }

</script>
      @endsection
    @section('page-script')


    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/pages/app-ecommerce-details.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-number-input.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
    @endsection


