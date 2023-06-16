<div class="row" id="table-hover-row">
    <div class="col-12">
      <div class="card">

       
        <div class="table-responsive">
          <table class="table table-hover ">
            <thead class="">
              <tr>
                <th></th>
                <th>{{ __('locale.Customer') }}</th>
                <th> {{ __('locale.Shipping Address') }}</th>
                <th>Date</th>
                <th>{{ __('locale.Status') }}</th>
                <th>Total</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($commandes as $commande)
                    
             
              <tr>
                {{-- <td><a
      
                    data-bs-toggle="collapse"
                    href="#collapseExample{{$commande->commande_id}}"
                    
                    aria-expanded="false"
                    aria-controls="collapseExample"
                  >
                  <i data-feather='chevron-down'></i>
                  </a>
                
                  
                </td> --}}
                <td>#0{{$commande->commande_id}}</td>
                <td> 
                    <div class="d-flex flex-row align-items-center mb-50">
                    <div class="avatar me-50">
                      <a href="{{route('Users.show',$commande->id)}}">
                      <img
                        src="{{asset('images/'.$commande->avatar)}}"
                        alt="Avatar"
                        width="38"
                        height="38"
                      /></a>
                    </div>
                    <div class="user-info">
                      <a href="{{route('Users.show',$commande->id)}}">
                      <h6 class="mb-0 text-primary">{{$commande->name}}</h6></a>
                      <small class="mb-0 text-muted">{{$commande->email}}</small>
                    </div>
                  </div>
                </td>
                <td><small class="text-muted">{{$commande->adress}}</small></td>
                <td>{{$commande->date}}</td>
                <td>
                  <span
                    @if ($commande->etat_id==1)
                      class="badge rounded-pill badge-light-info"
                    @elseif($commande->etat_id==2)
                      class="badge rounded-pill badge-light-success"
                    @else
                      class="badge rounded-pill badge-light-danger"

                    @endif
                    >
                    {{App\Models\Etat::where('id',$commande->etat_id)->first()->libelle}}
                  </span>
                </td>
                <td>${{$commande->total}}</td>
                <td><a href="{{route('Commande.show',$commande->commande_id)}}"><i  data-feather='eye'></i></a></td>
              </tr>
              {{-- <tbody class="collapse" id="collapseExample{{$commande->commande_id}}">
                @foreach ($ligne_commande as $item)
                    @if ($item->commande_id==$commande->commande_id)
                        
                    <tr>
                        <td><img src="{{asset($item->photo)}}" width="80" heghit="80"></td>
                        <td>{{$item->libelle}}</td>
                        <td>{{$item->quantite}}</td>
                        <td>${{$item->price}}</td>
                        
                    </tr>
                    @endif
                @endforeach
              
            </tbody> --}}
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>


  <section id="ecommerce-pagination ">
    <div class="row">
      <div class="col-sm-12">
        <nav id="pagination" aria-label="Page navigation example">


          {{$commandes->withQueryString()->links('pagination::bootstrap-5')}}
        </nav>
      </div>
    </div>
  </section>