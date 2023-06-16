@extends('layouts/detachedLayoutMaster')
    @section('title', 'Users')
        @section('vendor-style')
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
        
    @endsection
    @section('content')
        <!-- Hoverable rows start -->
        <div class="row">
          <div class="col-lg-4 col-sm-6">
            <div class="card">
              <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                  <h3 class="fw-bolder mb-75">{{$users->total()}}</h3>
                  <span>{{ __('locale.Total Users') }}</span>
                </div>
                <div class="avatar bg-light-primary p-50">
                  <span class="avatar-content">
                    <i data-feather="user" class="font-medium-4"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6">
            <div class="card">
              <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                  <h3 class="fw-bolder mb-75">{{count(App\Models\User::where('role_id',2)->get())}}</h3>
                  <span>{{ __('locale.Users') }}</span>
                </div>
                <div class="avatar bg-light-info p-50">
                  <span class="avatar-content">
                    <i data-feather="user-plus" class="font-medium-4"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-sm-6">
            <div class="card">
              <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                  <h3 class="fw-bolder mb-75">{{count(App\Models\User::where('role_id',1)->get())}}</h3>
                  <span>Admins</span>
                </div>
                <div class="avatar bg-light-success p-50">
                  <span class="avatar-content">
                    <i data-feather="user-check" class="font-medium-4"></i>
                  </span>
                </div>
              </div>
            </div>
          </div>
         
        </div>
  <div class="row" id="table-hover-row">

    <div class="col-12">
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
      <div class="card">
      
        <div class="card-body">
          <div class="modal-size-lg ">
            <!-- Button trigger modal -->
            <div class="row mb-2">
              <div class="col-4"></div>
              <div class="col-4 ">
                <input id="search" class="form-control" type="text" placeholder="{{ __('locale.Search') }}" />
              </div>
              <div class="col-4  ">
                <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#large">
                  {{ __('locale.Add User') }}
                </button>
              </div>
            </div>
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
                    <h4 class="modal-title" id="myModalLabel17">{{ __('locale.Add User') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form class="form" action="{{route('Users.store')}}" method="POST" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <div class="row">
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="first-name-column">  {{ __('locale.nom') }}</label>
                            <input
                              type="text"
                              id="first-name-column"
                              class="form-control"
                              placeholder="{{ __('locale.nom') }}"
                              name="name"
                            />
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="last-name-column">{{ __('locale.Email') }}</label>
                            <input
                              type="text"
                              id="last-name-column"
                              class="form-control"
                              placeholder="{{ __('locale.Email') }}"
                              name="email"
                            />
                            @if ($errors->has('email'))
                              <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="city-column">Avatar</label>
                            <input type="file" id="city-column" class="form-control" placeholder="Avatar" name="avatar" />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="country-floating">{{ __('locale.Password') }}</label>
                            <input
                              type="Password"
                              id="country-floating"
                              class="form-control"
                              name="{{ __('locale.Password') }}"
                              placeholder="Password"
                            />
                            @if ($errors->has('password'))
                            <span class="text-danger">{{ $errors->first('password') }}</span>
                          @endif
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="company-column">{{ __('locale.Address') }}</label>
                            <input
                              type="text"
                              id="company-column"
                              class="form-control"
                              name="{{ __('locale.Address') }}"
                              placeholder="address"
                            />
                            @if ($errors->has('address'))
                            <span class="text-danger">{{ $errors->first('address') }}</span>
                          @endif
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="email-id-column">{{ __('locale.Phone') }}</label>
                            <input
                              type="number"
                              id="email-id-column"
                              class="form-control"
                              name="{{ __('locale.Phone') }}"
                              placeholder="phone"
                            />
                            @if ($errors->has('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                          @endif
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <label class="form-label" for="select2-basic">{{ __('locale.City') }}</label>
                          <select class="select2 form-select form-control" name="ville" id="select2-basic">
                            <option value="">-- Select a City --</option>
                            @foreach ($villes as $ville)
                            <option value="{{$ville->id}}">{{$ville->name}}</option>
                            @endforeach
                          </select>
                          @if ($errors->has('ville'))
                          <span class="text-danger">{{ $errors->first('ville') }}</span>
                        @endif
                        </div>
                        <div class="col-md-6 col-12">
                          <label class="form-label" for="selectDefault">{{ __('locale.Role') }}</label>
                          <select class="form-select " name="role" id="selectDefault">
                              <option value="">-- Select a Role --</option>
                                      @foreach($roles as $role)
                                      <option value="{{$role->id}}">{{$role->libelle}}</option>
                                      @endforeach
                              </select>
                              @if ($errors->has('role'))
                              <span class="text-danger">{{ $errors->first('role') }}</span>
                            @endif
                      </div>
                      </div>         
                      <div class="modal-footer">
                        <button type="submit" rippleEffect class="btn btn-primary mr-1">Submit</button>
                        <button type="reset" rippleEffect class="btn btn-outline-secondary">Reset</button>
                      </div>
                    </form>
                </div>
              </div>
            </div>
          </div>
        <div class="table-responsive" id="users-content">
          
@include('content.ecommerce.Users.users-content')
                
          
        </div>
      </div>

      @if(Session::has('succes'))
        <script>
         $(document).ready(function () {
          Swal.fire('Succes!','User Addes Successfully!','success',{
       
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
      <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
      <!--/ Edit User Modal -->
      
    </div>
    <script>
      $(document).on('click', '.pagination a', function(event){
        event.preventDefault(); 
        var page = $(this).attr('href').split('page=')[1];
        $('#hidden_page').val(page);
        var query=$('#search').val();
        console.log(query);
        search_data(query,page)

      })
      

      $('#search').on('keyup',function(){
        var page=$('#hidden_page').val();
        var query = $(this).val();
        // console.log(query);
        search_data(query,page)

      })
      function search_data(query,page){
        $.ajax({
  url:"/search_user?page="+page+"&query="+query,
  success:function(data)
  {
    console.log(data);
    $("#users-content").html(data)
    feather.replace();
   
  }
 });}

    </script>

  </div>
    @endsection
    @section('page-script')
    <!-- Page js files -->
    
    <script src="{{ asset(mix('js/scripts/pages/app-ecommerce-details.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-number-input.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-wizard.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>

    @endsection