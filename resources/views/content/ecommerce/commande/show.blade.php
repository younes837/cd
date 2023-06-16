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
        <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-ecommerce.css')) }}">
        <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-ecommerce-details.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-number-input.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<style>
    .avatar-xxs{height:1.5rem;width:1.5rem}.avatar-xs{height:2rem;width:2rem}.avatar-sm{height:3rem;width:4rem}.avatar-md{height:4.5rem;width:4.5rem}.avatar-lg{height:6rem;width:6rem}.avatar-xl{height:7.5rem;width:7.5rem}.avatar-title{align-items:center;background-color:var(--tb-primary-text-emphasis);color:#fff;display:flex;font-weight:var(--tb-font-weight-medium);height:100%;justify-content:center;width:100%}.avatar-group{padding-left:12px;display:flex;flex-wrap:wrap}.avatar-group .avatar-group-item{margin-left:-12px;border:2px solid var(--tb-border-color);border-radius:50%;transition:all .2s}.avatar-group .avatar-group-item:hover{position:relative;transform:translateY(-2px);z-index:1}
</style>
        @endsection



    @section('vendor-script')
        <!-- Vendor js files -->
        <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/swiper.min.js')) }}"></script>
    @endsection
    @section('content')
    @if ($commande->etat_id==1)
        
    <div class="d-flex justify-content-end">
      <a href="{{url('/confirm_commande/'.$commande->id)}}" class="btn btn-sm btn-gradient-success mx-1"><i data-feather='check'></i> Confirm</a>
      <a href="{{url('/reject_commande/'.$commande->id)}}" class="btn btn-sm btn-gradient-danger"><i data-feather='x'></i> Reject</a>
      
    </div>
    @endif


    @if(Session::has('confirm'))
    <script>
     $(document).ready(function () {
      Swal.fire('Succes!','Order Confimed Successfully!','success',{
   
    confirmButtonClass: 'btn btn-primary',
    buttonsStyling: !1
  });
});
    </script>
  @endif
    @if(Session::has('reject'))
    <script>
     $(document).ready(function () {
      Swal.fire('Succes!','Order Rejected Successfully!','success',{
   
    confirmButtonClass: 'btn btn-primary',
    buttonsStyling: !1
  });
});
    </script>
  @endif

    <div class="row">
        <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0 mt-1">
            <div class="card card-profile">
                      
                <div class="card-body">
                  <div class="profile-image-wrapper">
                    <div class="profile-image">
                      <div class="avatar">
                        <img src="{{asset('/images/'.$user->avatar)}}" alt="Profile Picture" />
                      </div>
                    </div>
                  </div>
                  <h3>{{$user->name}}</h3>
                  <h6 class="text-muted">{{$user->email}}</h6>
                  <span class="badge badge-light-primary profile-badge">{{App\Models\Roles::where('id',$user->role_id)->first()->libelle}}</span>
                  <hr class="mb-2" />
                  
                 
                      <div class="col-xl-12 col-12">
                       
                        <dl class="row mb-0 text-start">
                          <dt class="col-sm-4 fw-bolder mb-1">Contact:</dt>
                          <dd class="col-sm-8 mb-1">+212-{{$user->phone}}</dd>
          
                          <dt class="col-sm-4 fw-bolder mb-1">{{ __('locale.Country') }}:</dt>
                          <dd class="col-sm-8 mb-1">Morroco</dd>
          
                          <dt class="col-sm-4 fw-bolder mb-1">{{ __('locale.City') }}:</dt>
                          <dd class="col-sm-8 mb-1">{{$commande->ville}}</dd>
          
                          <dt class="col-sm-4 fw-bolder mb-1">Zipcode:</dt>
                          <dd class="col-sm-8 mb-1">403114</dd>
                        </dl>
                      </div>
                      <div class="col-xl-12 col-12">
                          <dl class="row mb-0 text-start">
                              
              
                              <dt class="col-sm-4 fw-bolder mb-1">Tax ID:</dt>
                              <dd class="col-sm-8 mb-1">TAX-357378</dd>
              
                              <dt class="col-sm-4 fw-bolder mb-1">VAT Number:</dt>
                              <dd class="col-sm-8 mb-1">SDF754K77</dd>
              
                              <dt class="col-sm-4 fw-bolder mb-1">{{ __('locale.Address') }}:</dt>
                              <dd class="col-sm-8 mb-1 text-muted">{{$commande->adress}}</dd>
                            </dl>
                      </div>
                    </div>          
            </div> 
        </div>
        <div class="col-xl-8 col-lg-7 col-md-5 order-1 order-md-0">
            <h5 class="mx-1 fw-bolder">{{ __('locale.Ordered Product') }}</h5>
            <div class="card">

           
            <div class="table-responsive ">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      
                      <th>{{ __('locale.Product') }}</th>
                      <th>{{ __('locale.Price') }}</th>
                      <th>{{ __('locale.Quantity') }}</th>
                      <th>Total</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($ligne_commande as $item)
                          <tr>
                              
                          <td>
                              <div class="product-item d-flex align-items-center gap-2">
                                  <div class="avatar-sm flex-shrink-0">
                                      <div class="avatar-title bg-light rounded">
                                          <img src="{{asset($item->photo)}}" alt="" class="avatar-sm">
                                      </div>
                                  </div>
                                  <div class="flex-grow-1">
                                      <h6 class="fs-md"><a href="" class="text-reset">{{$item->libelle}}</a></h6>
                                      <p class="text-muted mb-0"><a href="#!" class="text-reset">{{App\Models\Brand::where('id',$item->brand_id)->first()->name}}</a></p>
                                  </div>
                              </div>
                          </td>
                          <td>@if ($item->promo)
                            <strike class="text-danger">${{$item->price}}</strike>
                            <span class="">${{$item->price-$item->price*($item->promo/100)}}</span></h6>
                          @else
                          ${{$item->price}}
                          @endif</td>
                          <td>{{$item->quantite}}</td>
                          <td>
                            @if ($item->promo)
                            ${{($item->price-$item->price*($item->promo/100))*$item->quantite}}
                            @else
                              
                            ${{$item->price*$item->quantite}}
                            @endif
                          </td>
                         
      
                         </tr>
                      @endforeach
                   
                  </tbody>
                </table>
                
              </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="amount-payable checkout-options">
                        <div class="card">
                          <div class="card-header">
                            <h4 class="card-title">Price Details</h4>
                            <a href="{{'/invoice/'.$commande->id}}" class="btn btn-success btn-sm">Invoice</a>
                          </div>
                          <div class="card-body">
                            <ul class="list-unstyled price-details">
                              <li class="row">
                                <div class="col">Price of {{count($ligne_commande)}} items</div>
                                <div class="col text-end">
                                  <strong>${{$commande->total}}</strong>
                                </div>
                              </li>
                              <li class="row mt-1">
                                <div class="col">Delivery Charges</div>
                                <div class="col text-success text-end">Free</div>
                              </li>
                            </ul>
                            <hr />
                            <ul class="list-unstyled price-details">
                              <li class="row">
                                <div class="col">Amount Payable</div>
                                <div class="col text-end">${{$commande->total}}</div>
                              </li>
                            </ul>
                          </div>
                        </div>
                      </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="card card-transaction">
                     
                      <div class="card-body">
                        <div class="transaction-item">
                          <div class="d-flex">
                            <div class="avatar bg-light-primary rounded float-start">
                              <div class="avatar-content">
                                <i data-feather="calendar" class="avatar-icon font-medium-3"></i>
                              </div>
                              
                            </div>
                            <div class="transaction-percentage">
                              <h6 class="transaction-title mt-1">{{ __('locale.Order Date') }}</h6>
                              
                            </div>
                          </div>
                          <div class="fw-bolder ">{{$commande->date}}</div>
                        </div>
                        <div class="transaction-item">
                          <div class="d-flex">
                            <div class="avatar bg-light-success rounded float-start">
                              <div class="avatar-content">
                                <i data-feather="truck" class="avatar-icon font-medium-3"></i>
                              </div>
                            </div>
                            <div class="transaction-percentage">
                              <h6 class="transaction-title mt-1">{{ __('locale.Deliver City') }}</h6>
                              
                            </div>
                          </div>
                          <div class="fw-bolder ">{{$commande->ville}}</div>
                        </div>
                        <div class="transaction-item">
                          <div class="d-flex">
                            <div class="avatar bg-light-danger rounded float-start">
                              <div class="avatar-content">
                                <i data-feather="dollar-sign" class="avatar-icon font-medium-3"></i>
                              </div>
                            </div>
                            <div class="transaction-percentage">
                              <h6 class="transaction-title mt-1">{{ __('locale.Order Amount') }}</h6>
                              
                            </div>
                          </div>
                          <div class="fw-bolder text-success">${{$commande->total}}</div>
                        </div>
                        <div class="transaction-item">
                          <div class="d-flex">
                            <div class="avatar bg-light-warning rounded float-start">
                              <div class="avatar-content">
                                <i data-feather="info" class="avatar-icon font-medium-3"></i>
                              </div>
                            </div>
                            <div class="transaction-percentage">
                              <h6 class="transaction-title mt-1">{{ __('locale.Order Status') }}</h6>
                           
                            </div>
                          </div>
                          <div class="fw-bolder "> <span
                            @if ($commande->etat_id==1)
                              class="badge rounded-pill badge-light-info"
                            @elseif($commande->etat_id==2)
                              class="badge rounded-pill badge-light-success"
                            @else
                              class="badge rounded-pill badge-light-danger"
            
                            @endif
                            >
                            {{App\Models\Etat::where('id',$commande->etat_id)->first()->libelle}}
                          </span></div>
                        </div>
                        
                      </div>
                    </div>
                  </div> 
            
                </div>
                
            <div>
        </div>
    </div>



    {{-- <div class="row" id="table-hover-row">
        <div class="row">
            <div class="col-lg-8 col-md-6 col-12">
                
                
                    <div class="card card-profile">
                      
                      <div class="card-body">
                        <div class="profile-image-wrapper">
                          <div class="profile-image">
                            <div class="avatar">
                              <img src="{{asset('/images/'.$user->avatar)}}" alt="Profile Picture" />
                            </div>
                          </div>
                        </div>
                        <h3>{{$user->name}}</h3>
                        <h6 class="text-muted">{{$user->email}}</h6>
                        <span class="badge badge-light-primary profile-badge">{{App\Models\Roles::where('id',$user->role_id)->first()->libelle}}</span>
                        <hr class="mb-2" />
                        
                        <div class="row ">
                            <div class="col-xl-5 col-12">
                             
                              <dl class="row mb-0 text-start">
                                <dt class="col-sm-4 fw-bolder mb-1">Contact:</dt>
                                <dd class="col-sm-8 mb-1">+212-{{$user->phone}}</dd>
                
                                <dt class="col-sm-4 fw-bolder mb-1">Country:</dt>
                                <dd class="col-sm-8 mb-1">Morroco</dd>
                
                                <dt class="col-sm-4 fw-bolder mb-1">city:</dt>
                                <dd class="col-sm-8 mb-1">{{$commande->ville}}</dd>
                
                                <dt class="col-sm-4 fw-bolder mb-1">Zipcode:</dt>
                                <dd class="col-sm-8 mb-1">403114</dd>
                              </dl>
                            </div>
                            <div class="col-xl-7 col-12">
                                <dl class="row mb-0 text-start">
                                    
                    
                                    <dt class="col-sm-4 fw-bolder mb-1">Tax ID:</dt>
                                    <dd class="col-sm-8 mb-1">TAX-357378</dd>
                    
                                    <dt class="col-sm-4 fw-bolder mb-1">VAT Number:</dt>
                                    <dd class="col-sm-8 mb-1">SDF754K77</dd>
                    
                                    <dt class="col-sm-4 fw-bolder mb-1">Address:</dt>
                                    <dd class="col-sm-8 mb-1 text-muted">{{$commande->adress}}</dd>
                                  </dl>
                            </div>
                          </div>
                      </div>
                 
                  </div> 
            </div>
          {{-- <div class="col-lg-4 col-md-6 col-12">
            <div class="card card-transaction">
             
              <div class="card-body">
                <div class="transaction-item">
                  <div class="d-flex">
                    <div class="avatar bg-light-primary rounded float-start">
                      <div class="avatar-content">
                        <i data-feather="calendar" class="avatar-icon font-medium-3"></i>
                      </div>
                      
                    </div>
                    <div class="transaction-percentage">
                      <h6 class="transaction-title mt-1">Order Date</h6>
                      
                    </div>
                  </div>
                  <div class="fw-bolder ">{{$commande->date}}</div>
                </div>
                <div class="transaction-item">
                  <div class="d-flex">
                    <div class="avatar bg-light-success rounded float-start">
                      <div class="avatar-content">
                        <i data-feather="truck" class="avatar-icon font-medium-3"></i>
                      </div>
                    </div>
                    <div class="transaction-percentage">
                      <h6 class="transaction-title mt-1">Deliver City</h6>
                      
                    </div>
                  </div>
                  <div class="fw-bolder ">{{$commande->ville}}</div>
                </div>
                <div class="transaction-item">
                  <div class="d-flex">
                    <div class="avatar bg-light-danger rounded float-start">
                      <div class="avatar-content">
                        <i data-feather="dollar-sign" class="avatar-icon font-medium-3"></i>
                      </div>
                    </div>
                    <div class="transaction-percentage">
                      <h6 class="transaction-title mt-1">Order Amount</h6>
                      
                    </div>
                  </div>
                  <div class="fw-bolder text-success">${{$commande->total}}</div>
                </div>
                <div class="transaction-item">
                  <div class="d-flex">
                    <div class="avatar bg-light-warning rounded float-start">
                      <div class="avatar-content">
                        <i data-feather="info" class="avatar-icon font-medium-3"></i>
                      </div>
                    </div>
                    <div class="transaction-percentage">
                      <h6 class="transaction-title mt-1">Order Status</h6>
                   
                    </div>
                  </div>
                  <div class="fw-bolder "> <span
                    @if ($commande->etat_id==1)
                      class="badge rounded-pill badge-light-info"
                    @elseif($commande->etat_id==2)
                      class="badge rounded-pill badge-light-success"
                    @else
                      class="badge rounded-pill badge-light-danger"
    
                    @endif
                    >
                    {{App\Models\Etat::where('id',$commande->etat_id)->first()->libelle}}
                  </span></div>
                </div>
                
              </div>
            </div>
          </div>     --}}

        {{-- <div class="col-12">
          <div class="card">
            {{-- <div class="p-1 d-flex justify-content-end">
                <button type="button" class="btn btn-sm btn-gradient-success mx-1">
                    <i data-feather='check'></i> Accept
                </button>
                <button type="button" class="btn btn-sm btn-gradient-danger">
                    <i data-feather='x'></i> Reject
                </button>
            </div> --}}
            {{-- <div class="table-responsive ">
              <table class="table table-hover">
                <thead>
                  <tr>
                    
                    <th >Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Amount</th>
                   
                  </tr>
                </thead>
                <tbody>
                    @foreach ($ligne_commande as $item)
                        <tr>
                            
                        <td>
                            <div class="product-item d-flex align-items-center gap-2">
                                <div class="avatar-sm flex-shrink-0">
                                    <div class="avatar-title bg-light rounded">
                                        <img src="{{asset($item->photo)}}" alt="" class="avatar-sm">
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fs-md"><a href="" class="text-reset">{{$item->libelle}}</a></h6>
                                    <p class="text-muted mb-0"><a href="#!" class="text-reset">{{App\Models\Brand::where('id',$item->brand_id)->first()->name}}</a></p>
                                </div>
                            </div>
                        </td>
                        <td>${{$item->price}}</td>
                        <td>{{$item->quantite}}</td>
                        <td>${{$item->price*$item->quantite}}</td>
                       
    
                       </tr>
                    @endforeach
                 
                </tbody>
              </table>
              
            </div> --}}
          {{-- </div>
        </div>
      </div>
     
    </div>  --}}
    


    @endsection
    @section('page-script')


    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/pages/app-ecommerce-details.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-number-input.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
    @endsection

