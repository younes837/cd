@extends('layouts/detachedLayoutMaster')

@section('title', 'Shop')

@section('vendor-style')
<!-- Vendor css files -->
<link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/nouislider.min.css')) }}">

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/swiper.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
        <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">

@endsection
@section('page-style')
<style>
 .flip-card {
  margin-top: 100px;
  background-color: transparent;
  width: 300px;
  height: 180px;
  perspective: 1000px;
}

.heading_8264 {
  position: absolute;
  letter-spacing: .2em;
  font-size: 0.5em;
  top: 2em;
  left: 29.6em;
}

.logo {
  position: absolute;
  top: 8.7em;
  left: 16.7em;
}

.chip {
  position: absolute;
  top: 2.3em;
  left: 1.8em;
}

.contactless {
  position: absolute;
  top: 4.5em;
  left: 17.9em;
}

.number {
  position: absolute;
  font-weight: bold;
  font-size: 0.7em;
  top: 8.3em;
  left: 2.6em;
}

.valid_thru {
  position: absolute;
  font-weight: bold;
  font-size: 8px;
  top: 13.6em;
  left: 3.2em;
}

.date_8264 {
  position: absolute;
  font-weight: bold;
  font-size: 8px;
  top: 14.6em;
  left: 4.2em;
}

.name {
  position: absolute;
  font-weight: bold;
  font-size: 0.6em;
  top: 16.1em;
  left: 3em;
}

.strip {
  position: absolute;
  background-color: black;
  width: 21.3em;
  height: 1.5em;
  top: 2.4em;
  background: repeating-linear-gradient(
    45deg,
    #303030,
    #303030 10px,
    #202020 10px,
    #202020 20px
  );
}

.mstrip {
  position: absolute;
  background-color: rgb(255, 255, 255);
  width: 14em;
  height: 0.8em;
  top: 5em;
  left: .8em;
  border-radius: 2.5px;
}

.sstrip {
  position: absolute;
  background-color: rgb(255, 255, 255);
  width: 4.1em;
  height: 0.8em;
  top: 5em;
  left: 16em;
  border-radius: 2.5px;
}

.code {
  font-weight: bold;
  text-align: center;
  margin: .2em;
  color: black;
}

.flip-card-inner {
  position: relative;
  width: 100%;
  height: 100%;
  text-align: center;
  transition: transform 0.8s;
  transform-style: preserve-3d;
}

.flip-card:hover .flip-card-inner {
  transform: rotateY(180deg);
}

.flip-card-front, .flip-card-back {
  box-shadow: 0 8px 14px 0 rgba(0,0,0,0.2);
  position: absolute;
  display: flex;
  flex-direction: column;
  justify-content: center;
  width: 100%;
  height: 100%;
  -webkit-backface-visibility: hidden;
  backface-visibility: hidden;
  border-radius: 1rem;
}

.flip-card-front {
  box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 2px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -1px 0px inset;
  background-color: #171717;
}

.flip-card-back {
  box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 2px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -1px 0px inset;
  background-color: #171717;
  transform: rotateY(180deg);
}
</style>
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-sliders.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-ecommerce.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
@endsection
@section('content')






<div id="step-payment" class="content" role="tabpanel" aria-labelledby="step-payment-trigger">
  <form id="checkout-payment" class="list-view product-checkout" action="{{url('/check')}}" method="post">
    <div class="payment-type">
      <div class="card">
        <div class="card-header flex-column align-items-start">
          <h4 class="card-title">Payment options</h4>
          <p class="card-text text-muted mt-25">Be sure to click on correct payment option</p>
        </div>
        <div class="card-body">

          <div class="customer-cvv mt-1 row row-cols-lg-auto w-50 d-flex justify-content-center">
            <div class="row">
                    @csrf
                    <div class="col-md-12 col-12">
                        <div class="mb-1">
                        <label class="form-label" for="first-name-column">Name</label>
                        <input
                            type="text"
                            id="name"
                            class="form-control"
                            placeholder="Name"
                            name="name"
                        />
                        </div>
                    </div>

                    <div class="col-md-12 col-12">
                        <div class="mb-1">
                        <label class="form-label" for="last-name-column">Card Number</label>
                        <input
                            type="number"
                            id="card_number"
                            class="form-control"
                            placeholder="**** **** **** ****"
                            name="numcarte"
                        />
                        </div>
                    </div>
                <div class="col-md-6 col-12">
                    <div class="mb-1">
                    <label class="form-label" for="city-column">Expiration (mm/yy)</label>
                    <input type="number" id="expiration" class="form-control" placeholder="mm/yy" name="experation"   />
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="mb-1">
                    <label class="form-label" for="country-floating">Security Code</label>
                    <input
                        type="number"
                        id="security"
                        class="form-control"
                        name="code"
                        placeholder="Security Code"
                    />
                    </div>
                </div>


                <hr class="my-2"/>
                <div class="gift-card mb-25">
                    <p class="card-text">

                        <button type="submit" class="btn btn-primary me-1" onClick="this.form.submit()" >Submit</button>
                        <button type="reset" class="btn btn-outline-secondary">Reset</button>


                    </p>
                </div>
            </div>
    </div>
  </div>
      </div>
    </div>
    <div class="amount-payable checkout-options ">
      <div class="flip-card mx-4">
        <div class="flip-card-inner">
            <div class="flip-card-front">
                <p class="heading_8264">MASTERCARD</p>
                <svg viewBox="0 0 48 48" height="36" width="36" y="0px" x="0px" xmlns="http://www.w3.org/2000/svg" class="logo">
                <path d="M32 10A14 14 0 1 0 32 38A14 14 0 1 0 32 10Z" fill="#ff9800"></path><path d="M16 10A14 14 0 1 0 16 38A14 14 0 1 0 16 10Z" fill="#d50000"></path><path d="M18,24c0,4.755,2.376,8.95,6,11.48c3.624-2.53,6-6.725,6-11.48s-2.376-8.95-6-11.48 C20.376,15.05,18,19.245,18,24z" fill="#ff3d00"></path>
                </svg>
                <svg xml:space="preserve" viewBox="0 0 50 50" height="30px" width="30px" y="0px" x="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" id="Layer_1" class="chip" version="1.1">  <image href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAMAAAAp4XiDAAAABGdBTUEAALGPC/xhBQAAACBjSFJN
                  AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAB6VBMVEUAAACNcTiVeUKVeUOY
                  fEaafEeUeUSYfEWZfEaykleyklaXe0SWekSZZjOYfEWYe0WXfUWXe0WcgEicfkiXe0SVekSXekSW
                  ekKYe0a9nF67m12ZfUWUeEaXfESVekOdgEmVeUWWekSniU+VeUKVeUOrjFKYfEWliE6WeESZe0GS
                  e0WYfES7ml2Xe0WXeESUeEOWfEWcf0eWfESXe0SXfEWYekSVeUKXfEWxklawkVaZfEWWekOUekOW
                  ekSYfESZe0eXekWYfEWZe0WZe0eVeUSWeETAnmDCoWLJpmbxy4P1zoXwyoLIpWbjvXjivnjgu3bf
                  u3beunWvkFWxkle/nmDivXiWekTnwXvkwHrCoWOuj1SXe0TEo2TDo2PlwHratnKZfEbQrWvPrWua
                  fUfbt3PJp2agg0v0zYX0zYSfgkvKp2frxX7mwHrlv3rsxn/yzIPgvHfduXWXe0XuyIDzzISsjVO1
                  lVm0lFitjVPzzIPqxX7duna0lVncuHTLqGjvyIHeuXXxyYGZfUayk1iyk1e2lln1zYTEomO2llrb
                  tnOafkjFpGSbfkfZtXLhvHfkv3nqxH3mwXujhU3KqWizlFilh06khk2fgkqsjlPHpWXJp2erjVOh
                  g0yWe0SliE+XekShhEvAn2D///+gx8TWAAAARnRSTlMACVCTtsRl7Pv7+vxkBab7pZv5+ZlL/UnU
                  /f3SJCVe+Fx39naA9/75XSMh0/3SSkia+pil/KRj7Pr662JPkrbP7OLQ0JFOijI1MwAAAAFiS0dE
                  orDd34wAAAAJcEhZcwAACxMAAAsTAQCanBgAAAAHdElNRQfnAg0IDx2lsiuJAAACLElEQVRIx2Ng
                  GAXkAUYmZhZWPICFmYkRVQcbOwenmzse4MbFzc6DpIGXj8PD04sA8PbhF+CFaxEU8iWkAQT8hEVg
                  OkTF/InR4eUVICYO1SIhCRMLDAoKDvFDVhUaEhwUFAjjSUlDdMiEhcOEItzdI6OiYxA6YqODIt3d
                  I2DcuDBZsBY5eVTr4xMSYcyk5BRUOXkFsBZFJTQnp6alQxgZmVloUkrKYC0qqmji2WE5EEZuWB6a
                  lKoKdi35YQUQRkFYPpFaCouKIYzi6EDitJSUlsGY5RWVRGjJLyxNy4ZxqtIqqvOxaVELQwZFZdkI
                  JVU1RSiSalAt6rUwUBdWG1CP6pT6gNqwOrgCdQyHNYR5YQFhDXj8MiK1IAeyN6aORiyBjByVTc0F
                  qBoKWpqwRCVSgilOaY2OaUPw29qjOzqLvTAchpos47u6EZyYnngUSRwpuTe6D+6qaFQdOPNLRzOM
                  1dzhRZyW+CZouHk3dWLXglFcFIflQhj9YWjJGlZcaKAVSvjyPrRQ0oQVKDAQHlYFYUwIm4gqExGm
                  BSkutaVQJeomwViTJqPK6OhCy2Q9sQBk8cY0DxjTJw0lAQWK6cOKfgNhpKK7ZMpUeF3jPa28BCET
                  amiEqJKM+X1gxvWXpoUjVIVPnwErw71nmpgiqiQGBjNzbgs3j1nus+fMndc+Cwm0T52/oNR9lsdC
                  S24ra7Tq1cbWjpXV3sHRCb1idXZ0sGdltXNxRateRwHRAACYHutzk/2I5QAAACV0RVh0ZGF0ZTpj
                  cmVhdGUAMjAyMy0wMi0xM1QwODoxNToyOSswMDowMEUnN7UAAAAldEVYdGRhdGU6bW9kaWZ5ADIw
                  MjMtMDItMTNUMDg6MTU6MjkrMDA6MDA0eo8JAAAAKHRFWHRkYXRlOnRpbWVzdGFtcAAyMDIzLTAy
                  LTEzVDA4OjE1OjI5KzAwOjAwY2+u1gAAAABJRU5ErkJggg==" y="0" x="0" height="50" width="50" id="image0"></image>
                </svg>
                <svg xml:space="preserve" viewBox="0 0 50 50" height="20px" width="20px" y="0px" x="0px" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns="http://www.w3.org/2000/svg" id="Layer_1" class="contactless" version="1.1">  <image href="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAQAAAC0NkA6AAAABGdBTUEAALGPC/xhBQAAACBjSFJN
                  AAB6JgAAgIQAAPoAAACA6AAAdTAAAOpgAAA6mAAAF3CculE8AAAAAmJLR0QA/4ePzL8AAAAJcEhZ
                  cwAACxMAAAsTAQCanBgAAAAHdElNRQfnAg0IEzgIwaKTAAADDklEQVRYw+1XS0iUURQ+f5qPyjQf
                  lGRFEEFK76koKGxRbWyVVLSOgsCgwjZBJJYuKogSIoOonUK4q3U0WVBWFPZYiIE6kuArG3VGzK/F
                  fPeMM/MLt99/NuHdfPd888/57jn3nvsQWWj/VcMlvMMd5KRTogqx9iCdIjUUmcGR9ImUYowyP3xN
                  GQJoRLVaZ2DaZf8kyjEJALhI28ELioyiwC+Rc3QZwRYyO/DH51hQgWm6DMIh10KmD4u9O16K49it
                  VoPOAmcGAWWOepXIRScAoJZ2Frro8oN+EyTT6lWkkg6msZfMSR35QTJmjU0g15tIGSJ08ZZMJkJk
                  HpNZgSkyXosS13TkJpZ62mPIJvOSzC1bp8vRhhCakEk7G9/o4gmZdbpsTcKu0m63FbnBP9Qrc15z
                  bkbemfgNDtEOI8NO5L5O9VYyRYgmJayZ9nPaxZrSjW4+F6Uw9yQqIiIZwhp2huQTf6OIvCZyGM6g
                  DJBZbyXifJXr7FZjGXsdxADxI7HUJFB6iWvsIhFpkoiIiGTJfjJfiCuJg2ZEspq9EHGVpYgzKqwJ
                  qSAOEwuJQ/pxPvE3cYltJCLdxBLiSKKIE5HxJKcTRNeadxfhDiuYw44zVs1dxKwRk/uCxIiQkxKB
                  sSctRVAge9g1E15EHE6yRUaJecRxcWlukdRIbGFOSZCMWQA/iWauIP3slREHXPyliqBcrrD71Amz
                  Z+rD1Mt2Yr8TZc/UR4/YtFnbijnHi3UrN9vKQ9rPaJf867ZiaqDB+czeKYmd3pNa6fuI75MiC0uX
                  XSR5aEMf7s7a6r/PudVXkjFb/SsrCRfROk0Fx6+H1i9kkTGn/E1vEmt1m089fh+RKdQ5O+xNJPUi
                  cUIjO0Dm7HwvErEr0YxeibL1StSh37STafE4I7zcBdRq1DiOkdmlTJVnkQTBTS7X1FYyvfO4piaI
                  nKbDCDaT2anLudYXCRFsQBgAcIF2/Okwgvz5+Z4tsw118dzruvIvjhTB+HOuWy8UvovEH6beitBK
                  xDyxm9MmISKCWrzB7bSlaqGlsf0FC0gMjzTg6GgAAAAldEVYdGRhdGU6Y3JlYXRlADIwMjMtMDIt
                  MTNUMDg6MTk6NTYrMDA6MDCjlq7LAAAAJXRFWHRkYXRlOm1vZGlmeQAyMDIzLTAyLTEzVDA4OjE5
                  OjU2KzAwOjAw0ssWdwAAACh0RVh0ZGF0ZTp0aW1lc3RhbXAAMjAyMy0wMi0xM1QwODoxOTo1Nisw
                  MDowMIXeN6gAAAAASUVORK5CYII=" y="0" x="0" height="50" width="50" id="image0"></image>
                </svg>
                <p class="number">9759 2484 5269 6576</p>
                <p class="valid_thru">VALID THRU</p>
                <p class="date_8264">mm/yy</p>
                <p class="name">Full Name</p>
            </div>
            <div class="flip-card-back">
                <div class="strip"></div>
                <div class="mstrip"></div>
                <div class="sstrip">
                  <p class="code">***</p>
                </div>
            </div>
        </div>
      </div>
    </div>
  </form>
  @if(Session::has('succes'))
                  <script>
                      $(document).ready(function () {
                      Swal.fire('Succes!','Commande Payed!','success',{

                  confirmButtonClass: 'btn btn-primary',
                  buttonsStyling: !1
                  });
                  });
                  </script>
    @elseif(Session::has('echoe'))
    <script>
                      $(document).ready(function () {
                      Swal.fire('Erreur!','Card Information are wrong !','error',{

                  confirmButtonClass: 'btn btn-primary',
                  buttonsStyling: !1
                  });
                  });
                  </script>
      @endif
</div>

@endsection

@section('vendor-script')
<!-- Vendor js files -->
<script>



  var count=1
  $('#name').on('keyup',function () {
    $('.name').text($(this).val().toUpperCase())
  })
  $('#security').on('keyup',function () {
    $('.code').text($(this).val().toUpperCase())
  })

  $('#card_number').keyup(function() {
                var inputVal = $(this).val();
                var formattedText = formatTextWithSpaces(inputVal);
                $('.number').text(formattedText);
            });

            function formatTextWithSpaces(text) {
                var formattedText = '';
                for (var i = 0; i < text.length; i++) {
                    if (i > 0 && i % 4 === 0) {
                        formattedText += ' ';
                    }
                    formattedText += text[i];
                }
                return formattedText;
            }

    $('#expiration').on('keyup',function () {
    $('.date_8264').text($(this).val().toUpperCase())
  })
  $('#expiration').keyup(function() {
                var inputVal = $(this).val();
                var formattedDate = formatExpirationDate(inputVal);
                $('.date_8264').text(formattedDate);
            });

            function formatExpirationDate(date) {
                var formattedDate = '';
                if (date.length >= 2) {
                    formattedDate += date.substring(0, 2) + '/';
                }
                if (date.length > 2) {
                    formattedDate += date.substring(2);
                }
                return formattedDate;
            }


</script>
<script src="{{ asset(mix('vendors/js/extensions/wNumb.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/nouislider.min.js')) }}"></script>
<script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
@endsection
@section('page-script')

<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/pages/app-ecommerce.js')) }}"></script>
@endsection
