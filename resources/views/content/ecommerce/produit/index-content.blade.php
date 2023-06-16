

        <table class="table table-hover ">
            <thead class="  ">
              <tr>
                <th scope="col">Product</th>
              {{-- <th scope="col">libelle</th> --}}
              <th scope="col">stock</th>
              <th scope="col">raiting</th>
              <th scope="col">price</th>
              <th scope="col">categorie</th>
              {{-- <th scope="col">propriete</th> --}}
              {{-- <th scope="col">brand</th> --}}
              <th scope="col">action</th>
              </tr>
              </thead>
              <tbody >
        @if (count($products)==0)
        <section id="alerts-with-title">
 
         
              <div class="alert alert-primary" role="alert">
                <h4 class="alert-heading"><i data-feather="info"></i>No <strong>product</strong> Found</h4>
              
              </div>
           
        
  </section>
@endif
    @foreach($products as $product)
    <tr>
      <td>
        <div class="product-item d-flex align-items-center gap-2">
          <div class="avatar-sm flex-shrink-0" >
              <a class="avatar-title bg-light rounded" href="{{route('product.show', $product->id)}}">
                  <img src="{{asset($product->photo)}}" alt="" class="avatar-sm">
              </a>
          </div>
          <div class="flex-grow-1">
              <h6 class="fs-md"><a href="{{route('product.show', $product->id)}}" class="text-reset">{{$product->libelle}}</a></h6>
              <p class="text-muted mb-0"><a href="#!" class="text-reset">{{App\Models\Brand::where('id',$product->brand_id)->first()->name}}</a></p>
          </div>
      </div>
      </td>
      {{-- <td scope="row"><img src="{{asset($product->photo)}}" width="80" heghit="80"></td> --}}
    {{-- <td scope="row">{{$product->libelle}}</td> --}}
    <td scope="row">
      @if ($product->stock!=0)
      <p class="card-text"> <span class="text-success">In stock</span></p>
      @else
      <p class="card-text"><span class="text-danger">Out of Stock</span></p>
          
      @endif
    </td>
    <td scope="row">{{$product->rating}}<i data-feather="star" class="filled-star " style="margin-bottom: 4px"></i></td>
    <td scope="row text-center">@if ($product->promo)
      <strike class="text-danger">${{$product->price}}</strike>
      <span class="">${{$product->price-$product->price*($product->promo/100)}}</span></h6>
    @else
    ${{$product->price}}
    @endif</td>
    <td scope="row">{{App\Models\Categorie::where('id',$product->categorie_id)->select('name')->first()->name}}</td>
    {{-- <td scope="row">{{App\Models\propriete::where('id',$product->propriete_id)->select('libelle')->first()->libelle}}</td> --}}
    {{-- <td scope="row">{{App\Models\Brand::where('id',$product->brand_id)->select('name')->first()->name}}</td> --}}

    <td><div class="dropdown">
  <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0" data-bs-toggle="dropdown">
    <i data-feather="more-vertical"></i>
  </button>
  <div class="dropdown-menu dropdown-menu-end">
    <a class="dropdown-item" href="{{ route('product.edit', $product->id) }}">
      <i data-feather="edit-2" class="me-50"></i>
      <span>Edit</span>
    </a>

    {{-- <a href="{{ route('product.destroy', $product->id) }}" class="dropdown-item" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $product->id }}').submit();">
                  <i data-feather="trash" class="me-50"></i>
                  <span>Delete</span>
                </a>
              <form id="delete-form-{{ $product->id }}" action="{{ route('product.destroy', $product->id) }}" method="POST" style="display: none;">
                  @csrf
                  @method('DELETE')
              </form> --}}
  </div>
</div>
</td>
    </tr>
    @endforeach
              </tbody>
            </table>
            <section id="ecommerce-pagination ">
              <div class="row">
                <div class="col-sm-12">
                  <nav id="pagination" aria-label="Page navigation example">
          
          
                    {{$products->withQueryString()->links('pagination::bootstrap-5')}}
                  </nav>
                </div>
              </div>
            </section>