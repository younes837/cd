

@if (Auth::check())
    
@foreach ($produits as $produit)
<div class="card ecommerce-card">
<div class="item-img text-center">
<a href="{{url('app/ecommerce/details/'.$produit->id)}}">
<img src="{{asset($produit->photo)}}" class="img-fluid" alt="img-placeholder" />
</a>
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
<div class="item-cost">
  <h6 class="item-price">${{$produit->price}}</h6>
</div>
</div>
<div class="item-name">
  <a href="{{url('app/ecommerce/details')}}">{{$produit->libelle}}</a>
</div>
<p class="card-text item-description">
  {{$produit->description}}  </p>
</div>
<div class="item-options text-center">
  <button type="button" class="btn btn-light btn-wishlist remove-wishlist">
    <input type="hidden" id="id" value="{{$produit->id}}">
<i data-feather="x"></i>
<span>Remove</span>
</button>
<button type="button" class="btn btn-primary btn-cart move-cart">
<i data-feather="shopping-cart"></i>
<span class="add-to-cart">Move to cart</span>
</button>
</div>
</div>
@endforeach
@else

vodka hh
@endif
<script type="text/javascript">
    function fetch_which(id)
    {
     $.ajax({
       url:'/app/ecommerce/shop/whishlist?&id='+id+"&details=remove",
      success:function(data)
      {
        console.log(data);
        $('.wishlist-items').html(data);
        feather.replace();
        
       
      }
     });
    }

    $('.remove-wishlist').on('click',function(){
      var $this = $(this);
      var $inner = $this.find('#id');
      var value = $inner.val();
      console.log(value);
      fetch_which(value)
    })

    

          
  
  
 
    
    </script>