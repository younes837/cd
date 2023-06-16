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
        <!-- Hoverable rows start -->
<div class="row ">


  {{-- @foreach($brands as $brand)
  <div class="card col-6 ">
    <div class="card-body">
      <div class="d-flex mb-2">
        <a href="{{asset('page/blog/detail')}}" class="me-2">
          <img
          class="rounded"
          src="{{asset($brand->image)}}"
          width="100"
          height="70"
          alt="Recent Post Pic"
          />
        </a>
        <div class="blog-info">
          <h6 class="blog-recent-post-title">
            <a href="{{asset('page/blog/detail')}}" class="text-body-heading">Why Should Forget Facebook?</a>
          </h6>
          <div class="text-muted mb-0">Jan 14 2020</div>
        </div>
      </div>
    </div>
  </div>
  @endforeach --}}
</div>
        
       

        <div class="row" id="table-hover-row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">{{ __('locale.Brand') }}</h4>
        </div>



        <div class="modal-size-lg text-end mb-2">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-primary mb-2 mx-2" data-bs-toggle="modal" data-bs-target="#large">
             {{ __('locale.Add Brand') }}
            </button>
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

                    <h4 class="modal-title" id="myModalLabel17">{{ __('locale.Add Brand') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form class="form" method="POST" action="{{route('brand.store')}}" enctype="multipart/form-data">
                        @csrf
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
                              placeholder="inserer une photo"
                              name="image"
                            />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="city-column">Descreption</label>
                            <input type="text" id="descreption-column" class="form-control" placeholder="descreption" name="description" />
                          </div>
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

        <div class="table-responsive">
          <table class="table table-hover">
          <thead>
            <tr>
              <th scope="col">{{ __('locale.Picture') }}</th>
            <th scope="col">{{ __('locale.Name') }}</th>
            <th scope="col">Descreption</th>
            <th></th>
            </tr>
        </thead>
          <tbody>
                @foreach($brands as $brand)
                    <tr>
                      <td scope="row"><img src="{{asset($brand->image)}}" width="80" heghit="80"></td>
                    <td scope="row">{{$brand->name}}</td>
                    <td scope="row">{{$brand->description}}</td>

                    <td><div class="dropdown">
                  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                    <i data-feather="more-vertical"></i>
                  </button>
                  <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="{{ route('brand.edit', $brand->id) }}">
                      <i data-feather="edit-2" class="me-50"></i>
                      <span>{{ __('locale.Edit') }}</span>
                    </a>

                    <a href="{{ route('brand.destroy', $brand->id) }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $brand->id }}').submit();">
                                  <i data-feather="trash" class="me-50"></i>
                                  <span>{{ __('locale.Delete') }}</span>
                                </a>
                              <form id="delete-form-{{ $brand->id }}" action="{{ route('brand.destroy', $brand->id) }}" method="POST" style="display: none;">
                                  @csrf
                                  @method('DELETE')
                              </form>
                  </div>
                </div>
            </td>
                    </tr>
                    @endforeach
          </tbody>
          </table>
        </div>
      </div>
    </div>

    <section id="ecommerce-pagination ">
    <div class="row">
      <div class="col-sm-12">
        <nav id="pagination" aria-label="Page navigation example">


          {{$brands->withQueryString()->links('pagination::bootstrap-5')}}
        </nav>
      </div>
    </div>
  </section>

  </div>

    @endsection
    @section('page-script')


    <!-- Page js files -->
    <script src="{{ asset(mix('js/scripts/pages/app-ecommerce-details.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-number-input.js')) }}"></script>
  <script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
    @endsection


