{{-- <div class="search-results">{{$produits->total()}} results found</div> --}}

@if(isset($produits))
<input type="hidden" id="count-product" value="{{session('length')}}">
    @foreach($produits as $produit)
  <div class="card ecommerce-card">
     <div class="item-img text-center">
       <a href="{{url('app/ecommerce/details/'.$produit->id)}}">
         <img
           class="img-fluid card-img-top"
           src="{{asset($produit->photo)}}"
           alt="img-placeholder"
       /></a>
     </div>
     <div class="card-body">
       <div class="item-wrapper">
         <div class="item-rating">
           <ul class="unstyled-list list-inline">
             @for ($i = 0; $i < $produit->rating; $i++)
    
               <li class="ratings-list-item"><i data-feather="star" class="filled-star"></i></li>
             @endfor
             @for ($i = 0; $i < 5 - $produit->rating; $i++)
    
               <li class="ratings-list-item"><i data-feather="star" class="unfilled-star"></i></li>
             @endfor  
           </ul>
         </div>
         <div>
           <h6 class="item-price">
            @if ($produit->promo)
              <strike class="text-danger">${{$produit->price}}</strike>
              <span class="">${{$produit->price-$produit->price*($produit->promo/100)}}</span></h6>
            @else
            ${{$produit->price}}
            @endif
         </div>
       </div>
       <h6 class="item-name">
         <a class="text-body" href="{{url('app/ecommerce/details/'.$produit->id)}}">{{$produit->libelle}}</a>
         {{-- <span class="card-text item-company">By <a href="#" class="company-name">{{$produit->brand}}</a></span> --}}
       </h6>
       <p class="card-text item-description">
         {{$produit->description}}
       </p>
     </div>
     <div class="item-options text-center">
       <div class="item-wrapper">
         <div class="item-cost">
           <h4 class="item-price">@if ($produit->promo)
            <strike class="text-danger">${{$produit->price}}</strike>
            <span class="">${{$produit->price-$produit->price*($produit->promo/100)}}</span></h6>
          @else
          ${{$produit->price}}
          @endif</h4>
         </div>
       </div>

       @if (Auth::check())
      <a href="#" class="btn btn-light btn-wishlist">
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
       <a href="{{ route('add_to_cart', $produit->id) }}"  class="btn btn-primary btn-cart">
         <i data-feather="shopping-cart"></i>
        
         <span class="add-to-cart">{{ __('locale.Add to cart') }}</span>
       </a>
     </div>
   </div> 
 
 
   @endforeach

   <section id="ecommerce-pagination  " class="">
    <div class="row">
      <div class="col-sm-12">
        <nav id="pagination" aria-label="Page navigation example">
 
   
          {{$produits->withQueryString()->links('pagination::bootstrap-5')}}
        </nav>
      </div>
    </div>
  </section>
  
@else

  @endif

  <script type="text/javascript">
    function fetch_which(id,page,wish)
    {
     $.ajax({
      url:'/app/ecommerce/shop/whishlist?page='+page+'&id='+id+"&details=non"+'&on='+wish,
      success:function(data)
      {
        // console.log(data);
        $('#ecommerce-products').html(data);
        feather.replace();
        
       
      }
     });
    }
    $('.btn-wishlist').on('click', function () {
          var $this = $(this);
          // $this.find('svg').toggleClass('text-danger');
          var page=$('#hidden_page').val();
          if (!$this.find('svg').hasClass('text-danger')) {
            toastr['success']('', 'Added to wishlist ❤️', {
              closeButton: false,
              tapToDismiss: true,
              rtl: true,
              showMethod: 'slideDown',
      hideMethod: 'slideUp',
      timeOut: 2000,
      
            })}
            var $inner = $this.find('#id');
           console.log($this.find('svg').hasClass('text-danger'));
            var value = $inner.val();
           if ($this.find('svg').hasClass('text-danger')) {
            var on='true'
           }else{
            var on='false'
           }
            fetch_which(value,page,on)
        })
        $(document).on('click', '.pagination a', function(event){
          event.preventDefault(); 
          var page = $(this).attr('href').split('page=')[1];
          $('#hidden_page').val(page);
        
});
        
    
    
    
    </script>
