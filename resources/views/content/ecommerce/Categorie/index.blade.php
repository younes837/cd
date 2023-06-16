@extends('layouts/detachedLayoutMaster')
    @section('title', 'Categorie')
        @section('vendor-style')
        <!-- Vendor css files -->
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/swiper.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/wizard/bs-stepper.min.css')) }}">
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
    <div class="card">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-header">
          <h4 class="card-title">Categories</h4>
        </div>
        <div class="card-body">
          <div class="modal-size-lg ">
            <!-- Button trigger modal -->
            <div class="d-flex justify-content-end pb-2">
              <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#large">
                {{ __('locale.Add Categorie') }}
              </button>
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
                    <h4 class="modal-title" id="myModalLabel17">{{ __('locale.Add Categorie') }}</h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form class="form" action="{{route('Categorie.store')}}" method="POST" enctype="multipart/form-data">
                      {{ csrf_field() }}
                      <div class="row">
                        <div class="col-12">
                          <div class="form-group">
                            <label for="first-name-column">{{ __('locale.Name') }}</label>
                            <input
                              type="text"
                              id="first-name-column"
                              class="form-control"
                              placeholder="Name"
                              name="cat_name"
                            />
                            @if ($errors->has('cat_name'))
                                <span class="text-danger">{{ $errors->first('cat_name') }}</span>
                            @endif
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
                <th>{{ __('locale.Name') }}</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($categories as $categorie)
                    <tr>
                        <td>
                            {{$categorie->name}}
                        </td>
                        <td>
                            <div class="dropdown">
                              <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
                                <i data-feather="more-vertical"></i>
                              </button>
                              <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#editCategorie{{$categorie->id}}">
                                  <i data-feather="edit-2" class="me-50"></i>
                                  <span>{{ __('locale.Edit') }}</span>
                                </a>                                
                                <a href="{{ route('Categorie.destroy', $categorie->id) }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $categorie->id }}').submit();">
                                  <i data-feather="trash" class="me-50"></i>
                                  <span>{{ __('locale.Delete') }}</span>
                                </a>
                              <form id="delete-form-{{ $categorie->id }}" action="{{ route('Categorie.destroy', $categorie->id) }}" method="POST" style="display: none;">
                                  @csrf
                                  @method('DELETE')
                              </form>
                              </div>
                            </div>
                        </td>
                      </tr>
                      <div class="modal fade" id="editCategorie{{$categorie->id}}" tabindex="-1" role="dialog" aria-labelledby="editCategorieLabel{{$categorie->id}}" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user" role="document">
                          <div class="modal-content">
                            <div class="modal-header bg-transparent">
                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body pb-5 px-sm-5 pt-50">
                              <div class="text-center mb-2">
                                <h1 class="mb-1">{{ __('locale.Edit Categorie Information') }}</h1>
                              </div>
                              <form class="form" action="{{route('Categorie.update',$categorie->id)}}" method="POST" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                @method("PUT")
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                        <label for="first-name-column">{{ __('locale.Name') }}</label>
                                        <input
                                            type="text"
                                            id="first-name-column"
                                            class="form-control"
                                            placeholder="Name"
                                            name="cat_name"
                                            value="{{$categorie->name}}"
                                        />
                                        @if ($errors->has('cat_name'))
                                            <span class="text-danger">{{ $errors->first('cat_name') }}</span>
                                        @endif
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
                @endforeach
            </tbody>
          </table>
          <section id="ecommerce-pagination ">
            <div class="row">
              <div class="col-sm-12">
                <nav id="pagination" aria-label="Page navigation example">
                  {{$categories->withQueryString()->links('pagination::bootstrap-5')}}
                </nav>
              </div>
            </div>
          </section>
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