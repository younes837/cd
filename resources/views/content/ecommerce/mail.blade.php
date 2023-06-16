<li class="nav-item dropdown dropdown-notification me-25">
   
        
    
    <a class="nav-link" href="javascript:void(0);" data-bs-toggle="dropdown">
      <i class="ficon" data-feather="bell"></i>
      @if (Auth::check())
          
      <span class="badge rounded-pill bg-danger badge-up">{{count(App\Models\Mails::where('user_id',Auth::user()->id)->get())}}</span>
      @else
      <span class="badge rounded-pill bg-danger badge-up">0</span>

      @endif
    </a>
    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-end">
      <li class="dropdown-menu-header">
        <div class="dropdown-header d-flex">
          <h4 class="notification-title mb-0 me-auto">Notifications</h4>
          @if (Auth::check())
          <div class="badge rounded-pill badge-light-primary">{{count(App\Models\Mails::where('user_id',Auth::user()->id)->get())}} {{ __('locale.New') }}</div>
          @else
          <div class="badge rounded-pill badge-light-primary">0 {{ __('locale.New') }}</div>

          @endif
        </div>
      </li>
      @if (Auth::check())
     
      <li class="scrollable-container media-list">
        @foreach (App\Models\Mails::where('user_id',Auth::user()->id)->get() as $item)     
            <a class="d-flex" @if(App\Models\Commande::find($item->commande_id)->etat_id==2) href="{{route('payment',$item->id)}}"  @endif>
                <div class="list-item d-flex align-items-start">
                    <div class="me-1">
                        @if (App\Models\Commande::find($item->commande_id)->etat_id==2)
                        <div class="avatar bg-light-success">
                            <div class="avatar-content"><i class="avatar-icon" data-feather="check"></i></div>
                          </div>
                        @elseif(App\Models\Commande::find($item->commande_id)->etat_id==3)
                            
                        <div class="avatar bg-light-danger">
                            <div class="avatar-content"><i class="avatar-icon" data-feather="x"></i></div>
                        </div>
                        @endif
                    </div>
                    <div class="list-item-body flex-grow-1">
                        <p class="media-heading"><span class="fw-bolder">{{$item->title}} : #0{{$item->commande_id}}</span></p>
                        <small class="notification-text"> {{$item->description}}</small>
                    </div>
                </div>
            </a>
        @endforeach
      
      </li>
           
      @endif
      @if (Auth::check())
          
      <li class="dropdown-menu-footer">
          <a class="btn btn-primary w-100" href="javascript:void(0)">Read all notifications</a>
        </li>
        @else
                
      <li class="dropdown-menu-footer">
        <a class="btn btn-primary w-100" href=":login">login / Register</a>
      </li>
        @endif
    </ul>
  </li>