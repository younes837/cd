
    <!-- Product Details starts -->
    <div class="card">
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
            <h4>{{$produit->libelle}}</h4>
            <span class="card-text item-company">By <a href="#" class="company-name">{{App\Models\Brand::find($produit->brand_id)->name}}</a></span>
            <div class="ecommerce-details-price d-flex flex-wrap mt-1">
              <h4 class="item-price me-1">@if ($produit->promo)
                <strike class="text-danger">${{$produit->price}}</strike>
                <span class="">${{$produit->price-$produit->price*($produit->promo/100)}}</span></h6>
              @else
              ${{$produit->price}}
              @endif</h4>
              <ul class="unstyled-list list-inline ps-1 border-start">
                <ul class="unstyled-list list-inline">
                  @for ($i = 0; $i < $produit->rating; $i++)
         
                    <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
                  @endfor
                  @for ($i = 0; $i < 5 - $produit->rating; $i++)
         
                    <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
                  @endfor
      
                 
                </ul>
              </ul>
            </div>
            @if ($produit->stock!=0)
            <p class="card-text">Available - <span class="text-success">{{ __('locale.in stock') }}</span></p>
            @else
            <p class="card-text">Unavailable - <span class="text-danger">{{ __('locale.out of stock') }}</span></p>
                
            @endif
            <p class="card-text">
             {{$produit->description}}
            </p>
            <ul class="product-features list-unstyled">
              <li><i data-feather="shopping-cart"></i> <span>Free Shipping</span></li>
              <li>
                <i data-feather="dollar-sign"></i>
                <span>EMI options available</span>
              </li>
            </ul>
            
            <hr />
            <div class="d-flex flex-column flex-sm-row pt-1">
              <a href="{{ route('add_to_cart', $produit->id) }}"  class="btn btn-primary btn-cart me-0 me-sm-1 mb-1 mb-sm-0">
                <i data-feather="shopping-cart" class="me-50"></i>
                <span class="add-to-cart">{{ __('locale.Add to cart') }}</span>
              </a>
              @if (Auth::check())
              <a href="#" class="btn btn-outline-secondary btn-wishlist me-0 me-sm-1 mb-1 mb-sm-0">
                @php
              $inWishlist = false;
              foreach ($wishlist as $item) {
                  if ($item->id == $produit->id) {
                      $inWishlist = true;
                      break;
                  }
              }
          @endphp
          <input type="hidden" id="id" value="{{$produit->id}}">
          @if ($inWishlist)
              <i class="text-danger" data-feather="heart"></i>
          @else
              <i data-feather="heart"></i>
          @endif
          <span>{{ __('locale.Wishlist') }}</span>
              </a>
              @endif
              <div class="btn-group dropdown-icon-wrapper btn-share">
                <button
                  type="button"
                  class="btn btn-icon hide-arrow btn-outline-secondary dropdown-toggle"
                  data-bs-toggle="dropdown"
                  aria-haspopup="true"
                  aria-expanded="false"
                >
                  <i data-feather="share-2"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                  <a href="#" class="dropdown-item">
                    <i data-feather="facebook"></i>
                  </a>
                  <a href="#" class="dropdown-item">
                    <i data-feather="twitter"></i>
                  </a>
                  <a href="#" class="dropdown-item">
                    <i data-feather="youtube"></i>
                  </a>
                  <a href="#" class="dropdown-item">
                    <i data-feather="instagram"></i>
                  </a>
                </div>
              </div>
            </div>
          </div> 
        </div>
        <div class="item-features">
          <div class="row text-center">
            <div class="col-12 col-md-4 mb-4 mb-md-0">
              <div class="w-75 mx-auto">
                <i data-feather="award"></i>
                <h4 class="mt-2 mb-1">100% {{ __('locale.Original') }}</h4>
              </div>
            </div>
            <div class="col-12 col-md-4 mb-4 mb-md-0">
              <div class="w-75 mx-auto">
                <i data-feather="clock"></i>
                <h4 class="mt-2 mb-1">{{ __('locale.10 day Replacement') }}</h4>
              </div>
            </div>
            <div class="col-12 col-md-4 mb-4 mb-md-0">
              <div class="w-75 mx-auto">
                <i data-feather="shield"></i>
                <h4 class="mt-2 mb-1">{{ __('locale.1 Year Warranty') }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
      </div>
      <script type="text/javascript">
          function fetch_which(id,on)
          {
           $.ajax({
            url:'/app/ecommerce/shop/whishlist?id='+id+"&details=oui"+"&on="+on,
            success:function(data)
            {
              console.log(data);
              $('.app-ecommerce-details').html(data);
              feather.replace();
              
             
            }
           });
          }
          $('.btn-wishlist').on('click', function () {
                var $this = $(this);
                // $this.find('svg').toggleClass('text-danger');
                
                if (!$this.find('svg').hasClass('text-danger')) {
                  toastr['success']('', 'Added to wishlist ❤️', {
                    closeButton: false,
                    tapToDismiss: true,
                    rtl: true
                  })}
                  
                
        
        
        var $inner = $this.find('#id');
        
        var value = $inner.val();
        if ($this.find('svg').hasClass('text-danger')) {
              var on='true'
             }else{
              var on='false'
             }
              fetch_which(value,on)
        
              
              })
          
          
          
          </script>