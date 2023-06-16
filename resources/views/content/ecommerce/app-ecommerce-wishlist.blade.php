@extends('layouts/detachedLayoutMaster')

@section('title', 'WishList')

@section('vendor-style')
  <!-- Vendor css files -->
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
@endsection
@section('page-style')
  <!-- Page css files -->
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-validation.css')) }}">
<style>
      .auth-wrapper {
      display: flex;
      flex-basis: 100%;
      min-height: 100vh;
      min-height: calc(var(--vh, 1vh) * 60);
      width: 100%;
    }
    .auth-wrapper .auth-inner {
      width: 100%;
    }
    .auth-wrapper.auth-basic {
      align-items: center;
      justify-content: center;
      overflow: hidden;
    }
    .auth-wrapper.auth-basic .auth-inner {
      position: relative;
    }
    .auth-wrapper.auth-basic .auth-inner:before {
      width: 244px;
      height: 243px;
      content: " ";
      position: absolute;
      top: -54px;
      left: -46px;
      background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAPQAAADzCAMAAACG9Mt0AAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAAA9KADAAQAAAABAAAA8wAAAADhQHfUAAAAyVBMVEUAAAD///+AgP+AgP9mZv+AgNWAgP9tbf9gYP+AgP9xcf9mZv+AZuaAgP9dXf90dOhiYv92dv9mZu5mZv93d+53d/9paf94afCAcfFrXvJra/9mZvJzZvJzc/JoaP96b/Rqav91aupsYvV2bOt2bPVxaPZ7cfZqavZyau1waPd4aO9xafBxafh4afB1bfh4avFuZ/F2afJzZvJzZ/N0aPN0bvN3bPR0ae5yZ/R3be93bfR1au9zafBxbPVzavV0a/F0a/ZyafFwaPKZm3nTAAAAQ3RSTlMAAQIEBQYGBwgICQoKCgsLDQ0PDw8PERESExMUFBQWFxgYGhoaGxsdHSAgIiIiIyQlJygqLCwtLi8vLzAzNDU3Nzg7h9vbHgAAA9RJREFUeNrt3ftS2kAUx/Fc1gSyWsErtuJdRDQiiteolb7/QzUoTm07k4AzObuu3/MCez45yWbzT36eZ6b8erO1e1B97baadd+zocJWmg0HaXe/+uqmg2GWtkLT5Lle1m9LdhG2+1lvzuiUO1knEF81yFc1N+35m15kZOGodz1vyLx+v2Lseq/erxtZd/NuweCTtfiwaWLOD5FnsqI7+VnP3y8afnEs3Es/1+H1qvETwuq18B7e6VlwLup1ZM8kWWQBOsrmHL7GVtxvYRZYgQ4ywae61ffsqH5Lbq20bQm6ncp9P2ehJegwE/u+rl95ttSwLrVSc2ANetAU28dSa9Cp2E623bUG3d2VWmn/wBq0XCugQYMGLdVKoOJaoiuok1NdXSW1WAUfRPtRUllflaJf5ZE/O9pXVbZUPTov5c+IDqvtRwStdTgLutoxy6GnGfYb2o+1I2gd+1OiqzfLocvVE7TSDqG1mgodaqfQZbvZC9rXjqG1X45WzqFVKVpk0LLo4lGP0ZGD6KgMnTiITkrQgXYQrYNitHISrYrRsZPouBhdcxJdK0YnTqKTYrR2Eq1BgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRoh9DH59ag86ACoSYOL61B55EUQk1s3VqDzsNHhJpYe7QGncfMSHUxaliCHgcKSXVxeWQJehwdJdXF4dAS9DgkTKqLxuibFeiXODixNi7OrEC/BP+JtbE0WrYA/RrxKNfH2YUF6NegSbk+Gk87xtErN6EsWm88fzeMXpwE9EruLns/l42io4dJFLPo2/Po1w+D6IW7t9Bt2SPx3vOOMfS7eHVZtN54ulg2go56138Ct4XRunE2Ovsmjg46WeddUoUWr6WL0fCoIYgO2/2s91fstDZQjcPL0ePt5flpdXUwqW46uMrS1j95JNpQrW0dHp9UV/uT2m416/8HVGg3qzhpBjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KBBgwYNGjRo0KC/FDpx0pwUo2tOomvF6NhJdFyMVk6iVTE6cBIdeF9vJyvZx/I/AzuIjsrQvoNovwzt4FamSs0Ojrp80PmvoB0zh940pb7azf1yg7t0LIt978uppzbnalfucDW92ZndLPRmKweGPduYJ+zoM5/Dk+gD5NdvLhXXPp88qcUqmEH5G5JZRs6cuxwIAAAAAElFTkSuQmCC");
    }

    @media (max-width: 575.98px) {
      .auth-wrapper.auth-basic .auth-inner:before {
        display: none;
      }
    }
    .auth-wrapper.auth-basic .auth-inner:after {
      width: 272px;
      height: 272px;
      content: " ";
      position: absolute;
      bottom: -55px;
      right: -75px;
      background-image: url("data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAARAAAAEQCAMAAABP1NsnAAAAAXNSR0IArs4c6QAAAERlWElmTU0AKgAAAAgAAYdpAAQAAAABAAAAGgAAAAAAA6ABAAMAAAABAAEAAKACAAQAAAABAAABEKADAAQAAAABAAABEAAAAAAQWxS2AAAAwFBMVEUAAAD///+AgICAgP9VVaqqVf+qqv+AgL+AgP9mZsxmZv+ZZv+AgNWAgP9tbdttbf+Sbf+AYN+AgN+AgP9xceNmZv+AZuaAZv90dOh0dP9qav+AauqAav+AgP92dv9tbf+Abe2Abf93Zu53d+6AcO94afCAcfF5a+R5a/JzZuaAZvKAc/J5bed5bfOAaPN6b/R1auqAavR6ZvV6cPV2bOuAbPV7aPZ2be2AbfZ7au17avZ3Zu53b+57a+97a/d4aO9J6CoeAAAAQHRSTlMAAQICAwMDBAQFBQUGBgcHBwgICAkKCgoLCwwMDAwNDg4ODw8QERITExQUFBUVFhcYGBkZGhobHBwdHR4eHx8gJ5uMWwAAA/FJREFUeNrt2G1XEkEYxvHZNk2xHGzdbKFl0cTwgdSkCKzu7/+t4pw6sAjtjIueE/f8r3fMO35nZnbuy5gVGcvfzJe0rnTfGI+MggGJRUZnbpPIhJKt88nU53JnFULvyISY6KAv8vPj0vr2rYwiE2Z2B9J+uNYcyyQxwWZvaeGH3G4bMjsvI/kcwTC/V+7kLoahlITzQojP3ZFgsJCh7IJQzpX0QFj4uMiY18eDMZ9bZCF9OQahnK6cm/Y7js0sh/LF3Auv1PlQd3MxbdXYIQspV44EEEAAAWTNDAYYkKdJbNMsLzYueZbaZ2iM46RVbHBaiZ9Js+nHEdli42N9XuSen5hGp1CQTuOJQDRsD99N4gMSpYWapNH6IJo83CIeILZQFesEaber79NCWRoukOpNEnW0gXQqD81w6ACxhbrYde7VuFCYeA2QRCNIsgZISyNIqz6IyhPjOjNVIFYniK3dmKU6QdLaJUimEySrDZLrBMlrgxRKU7sxCw/EMe0CAggggADySJCqxixIkKpNEh6IozELD8RxjQACCCCAAPJIkKrGLEgQXqqAAEJjxrQLCCCAAEJjRmNGY8a0CwgggABCYwYIfQgggNCYMe0CAggggNCY0ZjRmDHtAgIIIIAAQmNGHwIIIDRmTLuAAAIIIDRmNGY0Zky7gAACCCCA0JjRhwACCI0Z0y4ggAACCI0ZjRmNGdMuIIAAAgggNGb0IYAAQmPGtAsIIIAAQmNGY0ZjxrQLCCCAAAIIjRl9CCCA0Jgx7QICCCCA0JjRmNGYMe0CAggggABCY0YfAgggNGZMu4AAAgggNGY0ZjRmTLuAAAIIIIDQmNGHAAIIjRnTLiCAAAIIjRmNGY0ZIEy7gAACCCA0ZvQhgABCY8a0CwgggABCY0ZjBgiNGdMuIIAAAgiN2f/Sh+Q6PfLaIJlOkKw2SKoTJK3dmFmdILb2tBvrBIlrg5iWRo+WqQ+SaARJ1gCJAzsxThCN16p1vNurGjNjoo42j07kAHFskoY2kEbl33U0ZgoPjXW+Rl0gkarnahqtDaJKxMPDDWIiNafGenh4gExvVhXfmk7Da6L1AVGxSby2h6MxK79Zk42ea1pJbJ48sU2zDezQ8iy1z6BBwoyjMQsvXp8YQAAhgADilRfyy+wf8WqZZUfGZihvgZiB3FybC+kCUU5XLkAo50C+gbBQdUzkAIVyejIAYfFTI1solHP2HgNCnHn5AYNy4jvpoVB6fVzL91cwzLJ9Lfd7S0jhehxO5H5/yePr1W6gHonI7fJ5ORSR/n6Q2yQanq763zuXU5LJZRKiyD/W9/pjkdPZz0/yJ8fqVyry+qQZDMjJKoDfy8bRVhHhQTwAAAAASUVORK5CYII=");
      z-index: -1;
    }
    @media (max-width: 575.98px) {
      .auth-wrapper.auth-basic .auth-inner:after {
        display: none;
      }
    }
    .auth-wrapper.auth-cover {
      align-items: flex-start;
    }
    .auth-wrapper.auth-cover .auth-inner {
      height: 100vh;
      overflow-y: auto;
      height: calc(var(--vh, 1vh) * 100);
    }
    .auth-wrapper.auth-cover .brand-logo {
      position: absolute;
      top: 2rem;
      left: 2rem;
      margin: 0;
      z-index: 1;
      justify-content: unset;
    }
    .auth-wrapper.auth-basic .auth-inner {
      max-width: 400px;
    }
    .auth-wrapper .brand-logo {
      display: flex;
      justify-content: center;
      margin: 1rem 0 2rem 0;
    }
    .auth-wrapper .brand-logo .brand-text {
      font-weight: 600;
    }
    .auth-wrapper .auth-footer-btn .btn {
      padding: 0.6rem !important;
    }
    .auth-wrapper .auth-footer-btn .btn:not(:last-child) {
      margin-right: 1rem;
    }
    .auth-wrapper .auth-footer-btn .btn:focus {
      box-shadow: none;
    }
    .auth-wrapper .auth-input {
      max-width: 50px;
      padding-right: 0.571rem;
      padding-left: 0.571rem;
    }
    .auth-wrapper .custom-options-checkable .plan-price .pricing-value {
      font-size: 3rem;
    }
    .auth-wrapper .custom-options-checkable .plan-price sup {
      top: -1.5rem;
      left: 0.2rem;
    }
    .auth-wrapper .custom-options-checkable .plan-price sub {
      bottom: 0;
      right: 0.14rem;
    }

    @media (min-width: 1200px) {
      .auth-wrapper.auth-cover .auth-card {
        width: 400px;
      }
    }
    @media (max-width: 575.98px) {
      .auth-wrapper.auth-cover .brand-logo {
        left: 1.5rem;
        padding-left: 0;
      }
    }
    .auth-wrapper .auth-bg {
      background-color: #fff;
    }

    .dark-layout .auth-wrapper .auth-bg {
      background-color: #283046;
    }

    @media (max-height: 825px) and (max-width: 991.98px) {
      .dark-layout .auth-wrapper .auth-inner {
        background-color: #283046;
      }

      .auth-wrapper .auth-bg {
        padding-top: 3rem;
        margin: auto 0;
      }
      .auth-wrapper .auth-inner {
        background-color: #fff;
      }
      .auth-wrapper.auth-cover .auth-inner {
        padding-bottom: 1rem;
        display: flex;
        flex-direction: column;
        flex-wrap: nowrap;
      }
      .auth-wrapper.auth-cover .brand-logo {
        position: relative;
        left: 0;
        padding-left: 1.5rem;
      }
    }

</style>
  <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-ecommerce.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection

@section('content')
<!-- Wishlist Starts -->
@if (Auth::check())

@if (count($produits)==0)
<div>

              <div class="alert alert-secondary" role="alert">
          
                <div class="alert-body text center"><i style="margin-bottom: 3px" data-feather="info"></i>
                  No <a href="#" class="alert-link">Product</a> Added To The <a href="#" class="alert-link">Wishlist</a>
                  laborum!
                </div>
              </div>
            
    </div>
  </section>
    
</div>
@endif
<section id="wishlist" class="grid-view wishlist-items">
  @include('content/ecommerce/wishlist-content')
  
</section>
@else
<div class="auth-wrapper auth-basic px-2 ">
  <div class="auth-inner my-2">
    <!-- Forgot Password basic -->
    <div class="card mb-0">
      <div class="card-body">
        <a href="#" class="brand-logo">
          {{-- <img src="{{asset('images/logo/swift-shop.png')}}" width="100px" height="100px" alt=""> --}}
          <h2 class="brand-text text-primary ms-1">Swift Shop</h2>
        </a>

        <h4 class="card-title mb-1">Logged in to reach your wishlist!</h4>

        <form class="auth-forgot-password-form mt-2" action="/login" method="GET">
          <div class="mb-1">
         
          </div>
          <button class="btn btn-primary w-100" tabindex="2">login / Register</button>
        </form>

        <p class="text-center mt-2">
          <a href="{{url('/app/ecommerce/shop')}}"> <i data-feather="chevron-left"></i> Back to shop </a>
        </p>
      </div>
    </div>
    <!-- /Forgot Password basic -->
  </div>
</div>
@endif
<input type="hidden" name="hidden_page" id="hidden_page" value="1" />
@if(Auth::check())
<section id="ecommerce-pagination ">
  <div class="row">
    <div class="col-sm-12">
      <nav id="pagination" aria-label="Page navigation example">

 
        {{$produits->withQueryString()->links('pagination::bootstrap-5')}}
      </nav>
    </div>
  </div>
</section>
@endif
<!-- Wishlist Ends -->

{{-- <script type="text/javascript">
  function fetch_data(page)
  {
   $.ajax({
    url:'/app/ecommerce/wishlist-details?page='+page,
    success:function(data)
    {
      console.log(data);
      $('.wishlist-items').html(data);
      feather.replace();
      
     
    }
   });
  }
  $(document).on('click', '.pagination a', function(event){
 event.preventDefault(); 
 var page = $(this).attr('href').split('page=')[1];
 $('#hidden_page').val(page);
 console.log(page);

 fetch_data(page);
});
          
        



  
  
  </script> --}}
@endsection

@section('vendor-script')
  <!-- Vendor js files -->
  <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
  <script src="{{asset(mix('vendors/js/forms/validation/jquery.validate.min.js'))}}"></script>

@endsection
@section('page-script')
  <!-- Page js files -->
  <script src="{{asset(mix('js/scripts/pages/auth-forgot-password.js'))}}"></script>

  <script src="{{ asset(mix('js/scripts/pages/app-ecommerce-wishlist.js')) }}"></script>
@endsection


