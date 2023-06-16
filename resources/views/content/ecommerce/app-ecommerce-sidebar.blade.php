<div class="sidebar-shop">
    <div class="row">
      <div class="col-sm-12">
        <h6 class="filter-heading d-none d-lg-block">Filters</h6>
      </div>
    </div>
    <div class="card">
      <div class="card-body">

        {{-- Promotion Filter --}}
        <div class="multi-range-price">
          
          <ul class="list-unstyled price-range" id="Promotion">
            <li>
              <div class="form-check">
                <input type="radio" id="discount" name="discount" value="all" class="form-check-input" checked  />
                <label class="form-check-label" for="priceAll">{{ __('locale.all') }}</label>
              </div>
            </li>
            <li>
              <div class="form-check">
                <input type="radio" id="discount" name="discount" value="discount" class="form-check-input" />
                <label class="form-check-label" for="priceRange1">{{ __('locale.Discount') }}</label>
              </div>
            </li>
     
          </ul>
        </div>

        {{-- Promotion Filter --}}


        <!-- Price Filter starts -->
        <div class="multi-range-price">
          <h6 class="filter-title mt-0">{{ __('locale.Multi Range') }}</h6>
          <ul class="list-unstyled price-range" id="price-range">
            <li>
              <div class="form-check">
                <input type="radio" id="priceAll" name="price-range" value="all" class="form-check-input" checked  />
                <label class="form-check-label" for="priceAll">{{ __('locale.all') }}</label>
              </div>
            </li>
            <li>
              <div class="form-check">
                <input type="radio" id="priceRange1" name="price-range" value="100" class="form-check-input" />
                <label class="form-check-label" for="priceRange1">&lt;=$100</label>
              </div>
            </li>
            <li>
              <div class="form-check">
                <input type="radio" id="priceRange2" name="price-range" value="100-1000" class="form-check-input" />
                <label class="form-check-label" for="priceRange2">$100 - $1000</label>
              </div>
            </li>
            <li>
              <div class="form-check">
                <input type="radio" id="priceRange3" name="price-range" value="1000-5000" class="form-check-input" />
                <label class="form-check-label" for="priceARange3">$1000 - $5000</label>
              </div>
            </li>
            <li>
              <div class="form-check">
                <input type="radio" id="priceRange4" name="price-range" value="5000" class="form-check-input" />
                <label class="form-check-label" for="priceRange4">&gt;= $5000</label>
              </div>
            </li>
          </ul>
        </div>
        <!-- Price Filter ends -->
  
        <!-- Price Slider starts -->
        {{-- <div class="price-slider">
          <h6 class="filter-title">Price Range</h6>
          <div class="price-slider">
            <div class="range-slider mt-2" id="price-slider"></div>
          </div>
        </div> --}}
        <!-- Price Range ends -->
  
        <!-- Categories Starts -->
        <div id="product-categories">
          <h6 class="filter-title">Categories</h6>
          <ul class="list-unstyled categories-list">
            <li>
              <div class="form-check">
                <input type="radio" id="all" value="all" name="categorie" class="form-check-input" checked />
                <label class="form-check-label" for="all">{{ __('locale.all') }}</label>
              </div>
            </li>
            @foreach($categories as $categorie)
            <li>
              <div class="form-check">
                <input type="radio" id="{{$categorie->id}}" value="{{$categorie->id}}" name="categorie" class="form-check-input"  />
                <label class="form-check-label" for="{{$categorie->id}}">{{$categorie->name}}</label>
              </div>
            </li>
            @endforeach
           
          </ul>
        </div>
        <!-- Categories Ends -->
  
        <!-- Brands starts -->
        
        
        <!-- Brand ends -->
  
        <!-- Rating starts -->
        <div id="ratings">
          <h6 class="filter-title">{{ __('locale.Brand') }}</h6>
          <div class="list-unstyled categories-list">
            <li><input type="radio" id="all" value="all" name="brand" class="form-check-input" checked />
              <label class="form-check-label" for="all">{{ __('locale.all') }}</label>
            </li>  @foreach($brand as $item)
            <li>
              <div class="form-check">
                <input type="radio" id="{{$item->id}}" value="{{$item->id}}" name="brand" class="form-check-input"  />
                <img src="{{asset($item->image)}}" class="photos" height="20" width="20" alt="">
                {{-- <label class="form-check-label">{{$item->name}}</label> --}}
              </div>
            </li>
            @endforeach
          </div>
          
        </div>
        <!-- Rating ends -->
  
        <!-- Clear Filters Starts -->
        
        <!-- Clear Filters Ends -->
      </div>
    </div>
  </div>