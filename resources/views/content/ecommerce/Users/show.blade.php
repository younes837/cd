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
        @endsection
        @section('page-style')
        <!-- Page css files -->

        <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-ecommerce-details.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-number-input.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
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

<div class="row">
    <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
        <!-- User Card -->
        <div class="card">
          <div class="card-body">
            <div class="user-avatar-section">
              <div class="d-flex align-items-center flex-column">
                <img
                  class="img-fluid rounded mt-3 mb-2"
                  src="{{asset('images/'.$user->avatar)}}"
                  height="110"
                  width="110"
                  alt="User avatar"
                />
                <div class="user-info text-center">
                  <h4>{{$user->name}}</h4>
                  <span class="badge bg-light-primary">
                    @if ($user->role_id==1)
                        Admin
                    @else
                    User
                    @endif</span>
                </div>
              </div>
            </div>
           
            <h4 class="fw-bolder border-bottom pb-50 mb-1">Details</h4>
            <div class="info-container">
              <ul class="list-unstyled">
                <li class="mb-75">
                  <span class="fw-bolder me-25">{{ __('locale.Username') }}:</span>
                  <span>{{$user->name}}</span>
                </li>
                <li class="mb-75">
                  <span class="fw-bolder me-25"> {{ __('locale.Email') }}:</span>
                  <span>{{$user->email}}</span>
                </li>
           
                <li class="mb-75">
                  <span class="fw-bolder me-25">{{ __('locale.Contact') }}:</span>
                  <span>{{$user->phone}}</span>
                </li>
                <li class="mb-75">
                  <span class="fw-bolder me-25">{{ __('locale.City') }}:</span>
                  <span>{{App\Models\Ville::find($user->ville_id)->name}}</span>
                </li>
                <li class="mb-75">
                  <span class="fw-bolder me-25">{{ __('locale.Address') }}:</span>
                  <span>{{$user->adress}}</span>
                </li>
              </ul>
              <div class="d-flex justify-content-center pt-2">
                <a data-bs-toggle="modal" data-bs-target="#editUser{{$user->id}}" class="btn btn-primary me-1" >
                  {{ __('locale.Edit') }}
                </a>
              </div>
            </div>
          </div>
        </div>
        <!-- /User Card -->
        <!-- Plan Card -->
        
        <!-- /Plan Card -->
      </div>
      <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
        <!-- User Pills -->
   
        <!--/ User Pills -->
  
        <!-- Project table -->
        <div class="card">
          <h4 class="card-header">{{ __('locale.Products Ordred') }}</h4>
          <div class="table-responsive">
            <table class="table text-center">
              <thead>
                <tr>
              
                  <th>{{ __('locale.Product') }}</th>
                  <th class="text-nowrap">{{ __('locale.Name') }}</th>
                  <th>{{ __('locale.Quantity') }}</th>
                  {{-- <th>Total</th> --}}
                  <th>{{ __('locale.Date') }}</th>
                </tr>
              </thead>
              <tbody >
                @isset($commandes)
                    
                @foreach ($commandes as $commande)
                <tr>
                <td><a href="{{url('app/ecommerce/details/'.$commande->id)}}"><img src="{{asset($commande->photo)}}" width="80" heghit="80"></a></td>
                <td>{{$commande->libelle}}</td>
                <td >{{$commande->quantite}}</td>
                {{-- <td>${{$commande->total}}</td> --}}
                <td>{{$commande->date}}</td>
              </tr>
                @endforeach
                @endisset
              </tbody>
            </table>
          </div>
        </div>
        <!-- /Project table -->
  
        <!-- Activity Timeline -->
        
        <!-- /Activity Timeline -->
  
        <!-- Invoice table -->
      
        <!-- /Invoice table -->
      </div>
</div>
<div class="modal fade" id="editUser{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="editUserLabel{{$user->id}}" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user" role="document">
    <div class="modal-content">
      <div class="modal-header bg-transparent">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body pb-5 px-sm-5 pt-50">
        <div class="text-center mb-2">
          <h1 class="mb-1">{{ __('locale.Edit User Information') }}</h1>
        </div>
        {{-- start avatar --}}
        <div class="user-avatar-section">
          <div class="d-flex align-items-center flex-column">
            <img
              class="img-fluid rounded mt-1 mb-2"
              src="{{asset('images/'.$user->avatar )}}"
              height="110"
              width="110"
              alt="User avatar"
            />
            <div class="user-info text-center">
              <h4>{{$user->name}}</h4>
              @if ($user->role_id == 1)
                <span class="badge rounded-pill badge-light-success">Admin</span>
              @else
                <span class="badge rounded-pill badge-light-info">User</span>
              @endif
            </div>
          </div>
        </div>
        {{-- end avatar --}}

        <form class="form" action="{{route('Users.update',$user->id)}}" id="form_edit" method="POST" enctype="multipart/form-data">
          {{ csrf_field() }}
          @method("PUT")
          <div class="row">
            <div class="col-md-6 col-12">
              <div class="form-group">
                <label for="first-name-column">  {{ __('locale.Nom') }}</label>
                <input
                  type="text"
                  id="first-name-column"
                  class="form-control"
                  placeholder="Name"
                  name="name"
                  value="{{$user->name}}"
                />
               
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="form-group">
                <label for="last-name-column">{{ __('locale.Email') }}</label>
                <input
                  type="text"
                  id="last-name-column"
                  class="form-control"
                  placeholder="email"
                  name="email"
                  value="{{$user->email}}"
                />
               
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="form-group">
                <label for="city-column">Avatar</label>
                <input type="file" id="city-column" class="form-control" placeholder="City" name="avatar" />
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="form-group">
                <label for="country-floating">{{ __('locale.Password') }}</label>
                <input
                  type="Password"
                  id="country-floating"
                  class="form-control"
                  name="password"
                  placeholder="Password"
                  {{-- value="{{$user->password}}" --}}
                />
                
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="form-group">
                <label for="company-column">{{ __('locale.Address') }}</label>
                <input
                  type="text"
                  id="company-column"
                  class="form-control"
                  name="address"
                  placeholder="address"
                  value="{{$user->adress}}" 
                />
               
              </div>
            </div>
            <div class="col-md-6 col-12">
              <div class="form-group">
                <label for="email-id-column">{{ __('locale.Phone') }}</label>
                <input
                  type="number"
                  id="email-id-column"
                  class="form-control"
                  name="phone"
                  placeholder="phone"
                  value="{{$user->phone}}"
                />
               
              </div>
            </div>
            {{-- <div class="col-md-6 col-12">
              <label class="form-label" for="select2-basic">City</label>
              <select class="select2 form-select form-control" name="ville">
                <option value="">-- Select a City --</option>
                @foreach ($villes as $ville)
                <option value="{{$ville->id}}">{{$ville->name}}</option>
                @endforeach
              </select>
              @if ($errors->has('ville'))
              <span class="text-danger">{{ $errors->first('ville') }}</span>
              @endif
            </div> --}}
            <div class="col-md-6 col-12">
              <label class="form-label" for="selectDefault">{{ __('locale.Role') }}</label>
              <select class="form-select " name="role" id="selectDefault">
                <option value="">-- Select a Role --</option>
                @foreach ($roles as $role)
                    <option @if($role->id==$user->role_id) selected @endif value={{$role->id}}>{{$role->libelle}}</option>
                @endforeach
              
              </select>
            </div>
            <div class="col-md-6 col-12">
              <label class="form-label" for="selectDefault">{{ __('locale.City') }}</label>
              <select class="form-select " name="ville" id="selectDefault">
                <option value="">-- Select a City --</option>
                @foreach ($villes as $ville)
                <option @if($ville->id==$user->ville_id) selected @endif  value={{$ville->id}}>{{$ville->name}}</option>
                @endforeach
                
              </select>
            </div>
          </div>        
          <div class="modal-footer">
            <button data-id="{{$user->id}}" type="submit" id="button_edit" rippleEffect class="btn btn-primary mr-1">Submit</button>
            <button type="reset" rippleEffect class="btn btn-outline-secondary">Reset</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>







    @endsection
    @section('page-script')
    <!-- Page js files -->
    
    <script src="{{ asset(mix('js/scripts/pages/app-ecommerce-details.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-number-input.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-wizard.js')) }}"></script>
    <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>

    @endsection