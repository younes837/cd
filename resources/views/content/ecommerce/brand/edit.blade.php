@extends('layouts/detachedLayoutMaster')
    @section('title', 'Brand')
        @section('vendor-style')
        <!-- Vendor css files -->
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/swiper.min.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js%22%3E"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
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
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
    @endsection
    @section('content')


    <section class="app-ecommerce-details">
    <div class="card">

            <div class="card-titlle text-center mt-2">
                <h1>{{ __('locale.Edit') }} {{$brand->name}}</h1>
            </div>
            <div class="card-body">
                <div class="row my-2">
                        <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                            <div class="d-flex align-items-center justify-content-center">
                                <img
                                src="{{asset($brand->image)}}"
                                class="img-fluid brand-img"
                                alt="brand image"
                                />
                            </div>
                        </div>
                <div class="col-12 col-md-7">
                <form class="form" method="POST" action="{{route('brand.update',$brand->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                      <div class="row">
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="first-name-column">{{ __('locale.Name') }}</label>
                            <input
                              type="text"
                              id="first-name-column"
                              class="form-control"
                              placeholder="name"
                              name="name"
                              value="{{$brand->name}}"
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
                              placeholder="inserer une image"
                              name="image"

                            />
                          </div>
                        </div>
                        <div class="col-md-12 col-12">
                          <div class="form-group">
                            <label for="city-column">Descreption</label>
                            <input type="text" id="descreption-column" class="form-control" placeholder="descreption" name="description" value="{{$brand->description}}" />
                          </div>
                        </div>

                    </div>
                      <div class="modal-footer d-flex justify-content-center">
                        <button type="submit" rippleEffect class="btn btn-primary mr-1">Submit</button>
                        <button type="reset" rippleEffect class="btn btn-outline-secondary">Reset</button>
                      </div>
                  </form>

            </div>
    </div>

</section>

    @endsection
    @section('page-script')


    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/pages/app-ecommerce-details.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-number-input.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
    @endsection


