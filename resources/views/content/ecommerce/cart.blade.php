<li class="nav-item dropdown dropdown-cart me-25">
  <a class="nav-link" href="javascript:void(0);" data-bs-toggle="dropdown">
    <i class="ficon" data-feather="shopping-cart"></i>
    <span id="cart-count" class="badge rounded-pill bg-primary badge-up cart-item-count">
      {{ count((array) session('cart')) }}
      </span>
  </a>
  <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
    <li class="dropdown-menu-header">
      <div class="dropdown-header d-flex">
        <h4 class="notification-title mb-0 me-auto">{{ __('locale.My Cart') }}</h4>
        <div class="badge rounded-pill badge-light-primary"><span id="second-count">{{ count((array) session('cart')) }}</span> {{ __('locale.Items') }}</div>
      </div>
    </li>
    <li class="scrollable-container media-list">
      @if(session('cart'))
      @foreach(session('cart') as $id => $details)
      <div id="{{$id}}" class="list-item align-items-center">
        <img class="d-block rounded me-1" src="{{ asset($details['photo']) }}" alt="donuts"
          width="62">
        <div class="list-item-body flex-grow-1">         
          <div class="media-heading">
            <h6 class="cart-item-title"><a class="text-body" >
               {{$details["product_name"]}}</a></h6><small class="cart-item-by">{{$details['brand']}}</small>
          </div>
          <div class="cart-item-qty">
            <div class="input-group quantity-div"  data-id="{{$id}}">
              <span id="item-quantity">{{$details["quantity"]}}</span>
              {{-- <input disabled type="number" value=""> --}}
            </div>
          </div>
          <h5 id="cart-item-price">${{$details["price"]*$details["quantity"]}}</h5>
        </div>
      </div>
      @endforeach
      @endif
    </li>
    <li class="dropdown-menu-footer">
      <div class="d-flex justify-content-between mb-1">
        @php $total = 0 @endphp
                      @foreach((array) session('cart') as $id => $details)
                          @php $total += $details['price'] * $details['quantity'] @endphp
                      @endforeach
        <h6 class="fw-bolder mb-0">Total:</h6>
        <h6 id="cart-total" class="text-primary fw-bolder mb-0">${{$total}}</h6>
      </div>
      <a class="btn btn-primary w-100" href="{{ url('app/ecommerce/checkout') }}">Checkout</a>
    </li>
  </ul>
</li>

