@extends('layouts/detachedLayoutMaster')
    @section('title', 'Produit')
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
<!--
        <div>
        <form class="form" method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
                        @csrf
                      <div class="row">
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="first-name-column">libelle</label>
                            <input
                              type="text"
                              id="first-name-column"
                              class="form-control"
                              placeholder="libelle"
                              name="libelle"
                              value="{{$produit->libelle}}"
                            />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="last-name-column">photo</label>
                            <input
                              type="file"
                              id="last-name-column"
                              class="form-control"
                              placeholder="inserer une photo"
                              name="photo"

                            />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="city-column">descreption</label>
                            <input type="text" id="descreption-column" class="form-control" placeholder="descreption" name="description" value="{{$produit->libelle}}" />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="country-floating">stock</label>
                            <input
                              type="number"
                              id="stock-floating"
                              class="form-control"
                              name="stock"
                              placeholder="stock"
                              value="{{$produit->stock}}"
                            />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="company-column">rating</label>
                            <input
                              type="number"
                              id="rating-column"
                              class="form-control"
                              name="rating"
                              placeholder="rating"
                              value="{{$produit->rating}}"
                            />
                          </div>
                        </div>
                        <div class="col-md-6 col-12">
                          <div class="form-group">
                            <label for="email-id-column">price</label>
                            <input
                              type="price"
                              id="price-id-column"
                              class="form-control"
                              name="price"
                              placeholder="price"
                              value="{{$produit->price}}"
                            />
                          </div>
                        </div>
                      <div class="col-md-6 col-12">
                        <label class="form-label" for="selectDefault">categorie</label>
                        <select class="form-select " name="categorie" id="selectDefault">
                            <option value=""></option>
                                    @foreach($categories as $categorie)
                                    <option value="{{$categorie->id}}">{{$categorie->name}}</option>
                                    @endforeach
                            </select>
                    </div>
                    <div class="col-md-6 col-12">
                        <label class="form-label" for="selectDefault">propriete</label>
                        <select class="form-select " name="propriete" id="selectDefault">
                            <option value=""></option>
                                    @foreach($proprietes as $propriete)
                                    <option value="{{$propriete->id}}">{{$propriete->libelle}}</option>
                                    @endforeach
                            </select>
                    </div>
                    <div class="col-md-6 col-12">
                        <label class="form-label" for="selectDefault">brand</label>
                        <select class="form-select " name="brand" id="selectDefault">
                            <option value=""></option>
                                    @foreach($brands as $brand)
                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                    @endforeach
                            </select>
                    </div>

                    </div>
                      <div class="modal-footer">
                        <button type="submit" rippleEffect class="btn btn-primary mr-1">Submit</button>
                        <button type="reset" rippleEffect class="btn btn-outline-secondary">Reset</button>
                      </div>
                  </form>
        </div> -->


    <!-- Product Details starts -->

    <section class="app-ecommerce-details">
    <div class="card">

            <div class="card-titlle text-center mt-2">
                <h1>{{ __('locale.Edit') }} {{$produit->libelle}}</h1>
            </div>
            <div class="card-body">
                <div class="row my-2">
                        <div class="col-12 col-md-5 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                            <div class="d-flex align-items-center justify-content-center">
                                <img
                                src="{{asset($produit->photo)}}"
                                class="img-fluid product-img"
                                alt="product image"
                                />
                            </div>
                        </div>
                <div class="col-12 col-md-7">
                <form class="form" method="POST" action="{{route('product.update',$produit->id)}}" enctype="multipart/form-data">
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
                              placeholder="libelle"
                              name="libelle"
                              value="{{$produit->libelle}}"
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
                              name="photo"

                            />
                          </div>
                        </div>
                        <div class="col-md-12 col-12">
                          <div class="form-group">
                            <label for="city-column">Descreption</label>
                            <input type="text" id="descreption-column" class="form-control" placeholder="descreption" name="description" value="{{$produit->libelle}}" />
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
                              placeholder="stock"
                              value="{{$produit->stock}}"
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
                              value="{{$produit->rating}}"
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
                              value="{{$produit->price}}"
                            />
                          </div>
                        </div>
                      <div class="col-md-6 col-12">
                        <label class="form-label" for="selectDefault">Categorie</label>
                        <select class="form-select " name="categorie" id="selectDefault">
                                    @foreach($categories as $categorie)
                                    <option @if ($categorie->id==$produit->categorie_id)
                                      selected
                                    @endif value="{{$categorie->id}}">{{$categorie->name}}</option>
                                    @endforeach
                            </select>
                    </div>
                    <div class="col-md-6 col-12">
                        <label class="form-label" for="selectDefault">Propriete</label>
                        <select class="form-select " name="propriete" id="selectDefault">
                                    @foreach($proprietes as $propriete)
                                    <option @if ($propriete->id==$produit->propriete_id)
                                      selected
                                    @endif value="{{$propriete->id}}">{{$propriete->libelle}}</option>
                                    @endforeach
                            </select>
                    </div>
                    <div class="col-md-6 col-12">
                        <label class="form-label" for="selectDefault">{{ __('locale.Discount') }}</label>
                        <select class="form-select " name="brand" id="selectDefault">

                                    @foreach($brands as $brand)
                                    <option @if ($brand->id==$produit->brand_id)
                                      selected
                                    @endif value="{{$brand->id}}">{{$brand->name}}</option>
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
                            value="{{$produit->promo}}"
                            placeholder="Discount"
                          />
                          <span class="text-secondary">{{ __('locale.Left this field blank in case there is no discount') }}</span>
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


