<style>
  .cssbuttons-io-button {
    background: #7367F0;
    color: white;
    font-family: inherit;
    padding: 0.35em;
    padding-left: 1.2em;
    font-size: 17px;
    font-weight: 500;
    border-radius: 0.9em;
    border: none;
    letter-spacing: 0.05em;
    display: flex;
    align-items: center;
    box-shadow: inset 0 0 1.6em -0.6em #7367F0;
    overflow: hidden;
    position: relative;
    height: 2.8em;
    padding-right: 3.3em;
  }

  .cssbuttons-io-button .icon {
    background: white;
    margin-left: 1em;
    position: absolute;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 2.2em;
    width: 2.2em;
    border-radius: 0.7em;
    box-shadow: 0.1em 0.1em 0.6em 0.2em #7367F0;
    right: 0.3em;
    transition: all 0.3s;
  }

  .cssbuttons-io-button:hover .icon {
    width: calc(100% - 0.6em);
  }

  .cssbuttons-io-button .icon svg {
    width: 1.1em;
    transition: transform 0.3s;
    color: #7b52b9;
  }

  .cssbuttons-io-button:hover .icon svg {
    transform: translateX(0.1em);
  }

  .cssbuttons-io-button:active .icon {
    transform: scale(0.95);
  }

</style>

@if ($configData['mainLayoutType'] === 'horizontal' && isset($configData['mainLayoutType']))
  <nav
    class="header-navbar navbar-expand-lg navbar navbar-fixed align-items-center navbar-shadow navbar-brand-center "
    data-nav="brand-center">
    <div class="navbar-header d-xl-block d-none">
      <ul class="nav navbar-nav">
        
     <li class="nav-item">
          <a class="navbar-brand" href="{{ url('/') }}">
            <span class="brand-logo">
             <img style="margin-bottom: 7px"  src="{{asset('images/logo/swift-shop.png' )}}" width="30" height="35" alt="">
            </span> 
            <h2 class="brand-text mb-0">Swift Shop</h2>
          </a>
        </li>
      </ul>
    </div> 
  @else
    <nav
      class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-shadow container-xxl navbar-primary">
@endif
<div class="navbar-container d-flex content">
    <div class="bookmark-wrapper d-flex align-items-center">
    
    {{-- <ul class="nav navbar-nav bookmark-icons">
      <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ url('app/email') }}"
          data-bs-toggle="tooltip" data-bs-placement="bottom" title="Email"><i class="ficon"
            data-feather="mail"></i></a></li>
      <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ url('app/chat') }}"
          data-bs-toggle="tooltip" data-bs-placement="bottom" title="Chat"><i class="ficon"
            data-feather="message-square"></i></a></li>
      <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ url('app/calendar') }}"
          data-bs-toggle="tooltip" data-bs-placement="bottom" title="Calendar"><i class="ficon"
            data-feather="calendar"></i></a></li>
      <li class="nav-item d-none d-lg-block"><a class="nav-link" href="{{ url('app/todo') }}"
          data-bs-toggle="tooltip" data-bs-placement="bottom" title="Todo"><i class="ficon"
            data-feather="check-square"></i></a></li>
    </ul> --}}
    {{-- <ul class="nav navbar-nav">
      <li class="nav-item d-none d-lg-block">
        <a class="nav-link bookmark-star">
          <i class="ficon text-warning" data-feather="star"></i>
        </a>
        <div class="bookmark-input search-input">
          <div class="bookmark-input-icon">
            <i data-feather="search"></i>
          </div>
          <input class="form-control input" type="text" placeholder="Bookmark" tabindex="0" data-search="search">
          <ul class="search-list search-list-bookmark"></ul>
        </div>
      </li>
    </ul> --}}
  </div>
  <div class="bookmark-wrapper d-flex align-items-center">
    <ul class="nav navbar-nav d-xl-none">
      <li class="nav-item"><a class="nav-link menu-toggle" href="javascript:void(0);"><i class="ficon"
            data-feather="menu"></i></a></li>
    </ul>
    <ul class="nav navbar-nav">
      <li class="nav-item nav-search"><a class="nav-link nav-link-search"><i class="ficon"
        data-feather="search"></i></a>
    <div class="search-input">
      <div class="search-input-icon"><i data-feather="search"></i></div>
      <input class="form-control input" type="text" placeholder="Explore Products..." tabindex="-1" data-search="search">
      <div class="search-input-close"><i data-feather="x"></i></div>
      <ul class="search-list search-list-main"></ul>
    </div>
  </li>
      <li class="nav-item d-none d-lg-block">
        <a class="nav-link nav-link-style">
          <i class="ficon" data-feather="{{ $configData['theme'] === 'dark' ? 'sun' : 'moon' }}"></i>
        </a>
      </li>
      
    </ul>
    
  </div>
  <ul class="nav navbar-nav align-items-center ms-auto">
    <li class="nav-item dropdown dropdown-language">
      <a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown" aria-haspopup="true">
        <i class="flag-icon flag-icon-us"></i>
        <span class="selected-language">English</span>
      </a>
      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-flag">
        <a class="dropdown-item" href="{{ url('lang/en') }}" data-language="en">
          <i class="flag-icon flag-icon-us"></i> English
        </a>
        <a class="dropdown-item" href="{{ url('lang/fr') }}" data-language="fr">
          <i class="flag-icon flag-icon-fr"></i> French
        </a>
        
      </div>
    </li>
  @include('content/ecommerce/mail')

   {{-- Cart --}}
    @include('content/ecommerce/cart')
    {{-- Cart --}}
    @if(Auth::check())
    <li class="nav-item dropdown dropdown-user">
      <a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="javascript:void(0);"
        data-bs-toggle="dropdown" aria-haspopup="true">
        <div class="user-nav d-sm-flex d-none">
          <span class="user-name fw-bolder">
            @if (Auth::check())
              {{ Auth::user()->name }}
         
            @endif
          </span>
          <span class="user-status">
            @if (Auth::check())
            {{App\Models\Roles::where('id',Auth::user()->role_id)->first()->libelle}}
            @endif
    
          </span>
        </div>
        <span class="avatar">
          <img class="round"
            src="{{ Auth::user() ? asset('images/'.Auth::user()->avatar ) : asset('images/portrait/small/avatar-s-11.jpg') }}"
            alt="avatar" height="40" width="40">
          <span class="avatar-status-online"></span>
        </span>
      </a>
      <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown-user">
        <h6 class="dropdown-header">Manage Profile</h6>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item"
          href="/profile">
          <i class="me-50" data-feather="user"></i> Profile
        </a>
        {{-- @if (Auth::check() && Laravel\Jetstream\Jetstream::hasApiFeatures())
          <a class="dropdown-item" href="{{ route('api-tokens.index') }}">
            <i class="me-50" data-feather="key"></i> API Tokens
          </a>
        @endif --}}

        @if (Auth::user()->role_id==1)
            
        <a class="dropdown-item" href="/Dashboard">
          <i class="me-50" data-feather="settings"></i> Admin
        </a>
        @endif

        {{-- @if (Auth::User() && Laravel\Jetstream\Jetstream::hasTeamFeatures())
          <div class="dropdown-divider"></div>
          <h6 class="dropdown-header">Manage Team</h6>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item"
            href="{{ Auth::user() ? route('teams.show', Auth::user()->currentTeam->id) : 'javascript:void(0)' }}">
            <i class="me-50" data-feather="settings"></i> Team Settings
          </a>
          @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
            <a class="dropdown-item" href="{{ route('teams.create') }}">
              <i class="me-50" data-feather="users"></i> Create New Team
            </a>
          @endcan

          <div class="dropdown-divider"></div>
          <h6 class="dropdown-header">
            Switch Teams
          </h6>
          <div class="dropdown-divider"></div>
          @if (Auth::user())
            @foreach (Auth::user()->allTeams() as $team)
              {{-- Below commented code read by artisan command while installing jetstream. !! Do not remove if you want to use jetstream. --}}

              {{-- <x-jet-switchable-team :team="$team" /> --}}
            {{-- @endforeach
          @endif
          <div class="dropdown-divider"></div>
        @endif  --}}
        @if (Auth::check())
          <a class="dropdown-item" href="{{ route('signout') }}"
            >
            <i class="me-50" data-feather="log-out"></i> Log-Out
          </a>
          {{-- <form method="POST" id="logout-form" action="{{ route('signout') }}">
            @csrf
          </form> --}}
        @else
          <a  class="dropdown-item" href="{{ Route::has('login') ? route('login') : 'javascript:void(0)' }}">
            <i class="me-50" data-feather="log-in"></i> Login
          </a>
          
        @endif
      </div>
    </li>
    @else
    {{-- <button class="cssbuttons-io-button"> Get started
      <div class="icon">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"></path><path fill="currentColor" d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"></path></svg>
      </div>
    </button> --}}
    <a  href="/login">
       Login
    </a>
    @endif
  </ul>
</div>
</nav>

{{-- Search Start Here --}}
<ul class="main-search-list-defaultlist d-none">

</ul>

{{-- if main search not found! --}}
<ul class="main-search-list-defaultlist-other-list d-none">
  <li class="auto-suggestion justify-content-between">
    <a class="d-flex align-items-center justify-content-between w-100 py-50">
      <div class="d-flex justify-content-start">
        <span class="me-75" data-feather="alert-circle"></span>
        <span>No results found.</span>
      </div>
    </a>
  </li>
</ul>
{{-- Search Ends --}}
<!-- END: Header-->
