@extends('layouts/detachedLayoutMaster')

@section('title', 'Invoice Preview')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('vendors/css/pickers/flatpickr/flatpickr.min.css')}}">
@endsection
@section('page-style')
<link rel="stylesheet" href="{{asset('css/base/plugins/forms/pickers/form-flat-pickr.css')}}">
<link rel="stylesheet" href="{{asset('css/base/pages/app-invoice.css')}}">
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-ecommerce.css')) }}">
<!-- Page css files -->
<link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-ecommerce-details.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-number-input.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
<link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
<style>
  .avatar-xxs{height:1.5rem;width:1.5rem}.avatar-xs{height:2rem;width:2rem}.avatar-sm{height:3rem;width:4rem}.avatar-md{height:4.5rem;width:4.5rem}.avatar-lg{height:6rem;width:6rem}.avatar-xl{height:7.5rem;width:7.5rem}.avatar-title{align-items:center;background-color:var(--tb-primary-text-emphasis);color:#fff;display:flex;font-weight:var(--tb-font-weight-medium);height:100%;justify-content:center;width:100%}.avatar-group{padding-left:12px;display:flex;flex-wrap:wrap}.avatar-group .avatar-group-item{margin-left:-12px;border:2px solid var(--tb-border-color);border-radius:50%;transition:all .2s}.avatar-group .avatar-group-item:hover{position:relative;transform:translateY(-2px);z-index:1}
</style>
@endsection

@section('content')
<section class="invoice-preview-wrapper">
  <div class="row invoice-preview">

      <!-- Invoice -->
      <div class="col-xl-9 col-md-8 col-12">
        <div class="card invoice-preview-card">
          <div class="card-body invoice-padding pb-0">
            <!-- Header starts -->
            <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0">
              <div>
                <div class="logo-wrapper">
                                    <h3 class="text-primary invoice-logo">Swift Shop</h3>
                </div>
                <p class="card-text mb-25">123 Street, City, State, ZIP</p>
                <p class="card-text mb-25">Morocco, Casablanca</p>
                <p class="card-text mb-0">+1 (123) 456 7891</p>
              </div>
              <div class="mt-md-0 mt-2">
                <h4 class="invoice-title">
                  Invoice
                  <span class="invoice-number">#INV0{{$commande->id}}</span>
                </h4>
                <div class="invoice-date-wrapper">
                  <p class="invoice-date-title">Date Issued:</p>
                  <p class="invoice-date">{{$commande->date}}</p>
                </div>
                <div class="invoice-date-wrapper">
                  <p class="invoice-date-title">Due Date:</p>
                  <p class="invoice-date">29/08/2020</p>
                </div>
              </div>
            </div>
            <!-- Header ends -->
          </div>
  
          <hr class="invoice-spacing" />
  
          <!-- Address and Contact starts -->
          <div class="card-body invoice-padding pt-0">
            <div class="row invoice-spacing">
              <div class="col-xl-8 p-0">
                <h6 class="mb-2">Invoice To:</h6>
                <h6 class="mb-25">{{App\Models\User::find($commande->user_id)->name}}</h6>
                
                <p class="card-text mb-25">{{App\Models\ville::find(App\Models\User::find($commande->user_id)->ville_id)->name}}</p>
                <p class="card-text mb-25">{{App\Models\User::find($commande->user_id)->adress}}</p>
                <p class="card-text mb-25">{{App\Models\User::find($commande->user_id)->phone}}</p>
                <p class="card-text mb-0">{{App\Models\User::find($commande->user_id)->email}}</p>
              </div>
              <div class="col-xl-4 p-0 mt-xl-0 mt-2">
                <h6 class="mb-2">Payment Details:</h6>
                <table>
                  <tbody>
                    <tr>
                      <td class="pe-1">Total Due:</td>
                      <td><span class="fw-bold">${{$commande->total}}</span></td>
                    </tr>
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <!-- Address and Contact ends -->
  
          <!-- Invoice Description starts -->
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th class="py-1">Product</th>
                  <th class="py-1">Price</th>
                  <th class="py-1">Quantity</th>
                  <th class="py-1 d-flex justify-content-end">Total</th>
                </tr>
              </thead>
              <tbody>
                @foreach (App\Models\ligneCommande::where('commande_id',$commande->id)->join('produit','produit.id','produit_commande.produit_id')->get() as $item)
                    
                <tr>
                  <td class="py-1">
                    <div class="product-item d-flex align-items-center gap-2">
                      <div class="avatar-sm flex-shrink-0">
                        <div class="avatar-title bg-light rounded">
                          <img src="{{asset($item->photo)}}" alt="" class="avatar-sm">
                        </div>
                      </div>
                      <div class="flex-grow-1">
                        <h6 class="fs-md"><a href="" class="text-reset">{{$item->libelle}}</a></h6>
                        <p class="text-muted mb-0"><a href="#!" class="text-reset">{{App\Models\Brand::where('id',$item->brand_id)->first()->name}}</a></p>
                      </div>
                    </div>
                  </td>
                  <td class="py-1">
                    <span class="fw-bold">@if ($item->promo)<strike class="text-danger">${{$item->price}}</strike><span class="">${{$item->price-$item->price*($item->promo/100)}}</span></h6>@else
                    ${{$item->price}}@endif</span>
                  </td>
                  <td class="py-1">
                    <span class="fw-bold">{{$item->quantite}}</span>
                  </td>
                  <td class="py-1 d-flex justify-content-end ">
                    <span class="fw-bold">${{$item->price*$item->quantite}}</span>
                  </td>
                </tr>
                @endforeach
                
              </tbody>
            </table>
          </div>
  
          <div class="card-body invoice-padding pb-0">
            <div class="row invoice-sales-total-wrapper">
              <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                
              </div>
              <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                <div class="invoice-total-wrapper">
                  <div class="invoice-total-item">
                    <p class="invoice-total-title">Subtotal:</p>
                    <p class="invoice-total-amount">${{$commande->total}}</p>
                  </div>
                  <div class="invoice-total-item">
                    <p class="invoice-total-title">Shipping:</p>
                    <p class="invoice-total-amount text-success">Free</p>
                  </div>
                 
                  <hr class="my-50" />
                  <div class="invoice-total-item">
                    <p class="invoice-total-title">Total:</p>
                    <p class="invoice-total-amount">${{$commande->total}}</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Invoice Description ends -->
  
          <hr class="invoice-spacing" />
  
          <!-- Invoice Note starts -->
          <div class="card-body invoice-padding pt-0">
            <div class="row">
              <div class="col-12">
                <span class="fw-bold">Note:</span>
                <span
                  >It was a pleasure working with you and your team. We hope you will keep us in mind for future freelance
                  projects. Thank You!</span
                >
              </div>
            </div>
          </div>
          <!-- Invoice Note ends -->
        </div>
      </div>
      <!-- /Invoice -->
  
      <!-- Invoice Actions -->
      
      <!-- /Invoice Actions -->
    
<div class="col-xl-3 col-md-4 col-12 invoice-actions mt-md-0 mt-2">
  <div class="card">
    <div class="card-body">
      <button class="btn btn-primary w-100 mb-75" data-bs-toggle="modal" data-bs-target="#send-invoice-sidebar">
        Send Invoice
      </button>
      <a href="{{url('download_invoice/'.$commande->id)}}" class="btn btn-outline-secondary w-100 btn-download-invoice mb-75">Download</a>
      <a class="btn btn-outline-secondary w-100 mb-75" href="{{url('app/invoice/print')}}" target="_blank"> Print </a>
      <a class="btn btn-outline-secondary w-100 mb-75" href="{{url('app/invoice/edit')}}"> Edit </a>
      <button class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#add-payment-sidebar">
        Add Payment
      </button>
    </div>
  </div>
</div>
</div>
</section>
<!-- Send Invoice Sidebar -->
<div class="modal modal-slide-in fade" id="send-invoice-sidebar" aria-hidden="true">
  <div class="modal-dialog sidebar-lg">
    <div class="modal-content p-0">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
      <div class="modal-header mb-1">
        <h5 class="modal-title">
          <span class="align-middle">Send Invoice</span>
        </h5>
      </div>
      <div class="modal-body flex-grow-1">
        <form>
          <div class="mb-1">
            <label for="invoice-from" class="form-label">From</label>
            <input
              type="text"
              class="form-control"
              id="invoice-from"
              value="shelbyComapny@email.com"
              placeholder="company@email.com"
            />
          </div>
          <div class="mb-1">
            <label for="invoice-to" class="form-label">To</label>
            <input
              type="text"
              class="form-control"
              id="invoice-to"
              value="qConsolidated@email.com"
              placeholder="company@email.com"
            />
          </div>
          <div class="mb-1">
            <label for="invoice-subject" class="form-label">Subject</label>
            <input
              type="text"
              class="form-control"
              id="invoice-subject"
              value="Invoice of purchased Admin Templates"
              placeholder="Invoice regarding goods"
            />
          </div>
          <div class="mb-1">
            <label for="invoice-message" class="form-label">Message</label>
            <textarea
              class="form-control"
              name="invoice-message"
              id="invoice-message"
              cols="3"
              rows="11"
              placeholder="Message..."
            >
Dear Queen Consolidated,

Thank you for your business, always a pleasure to work with you!

We have generated a new invoice in the amount of $95.59

We would appreciate payment of this invoice by 05/11/2019</textarea
            >
          </div>
          <div class="mb-1">
            <span class="badge badge-light-primary">
              <i data-feather="link" class="me-25"></i>
              <span class="align-middle">Invoice Attached</span>
            </span>
          </div>
          <div class="mb-1 d-flex flex-wrap mt-2">
            <button type="button" class="btn btn-primary me-1" data-bs-dismiss="modal">Send</button>
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /Send Invoice Sidebar -->

<!-- Add Payment Sidebar -->
<div class="modal modal-slide-in fade" id="add-payment-sidebar" aria-hidden="true">
  <div class="modal-dialog sidebar-lg">
    <div class="modal-content p-0">
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
      <div class="modal-header mb-1">
        <h5 class="modal-title">
          <span class="align-middle">Add Payment</span>
        </h5>
      </div>
      <div class="modal-body flex-grow-1">
        <form>
          <div class="mb-1">
            <input id="balance" class="form-control" type="text" value="Invoice Balance: 5000.00" disabled />
          </div>
          <div class="mb-1">
            <label class="form-label" for="amount">Payment Amount</label>
            <input id="amount" class="form-control" type="number" placeholder="$1000" />
          </div>
          <div class="mb-1">
            <label class="form-label" for="payment-date">Payment Date</label>
            <input id="payment-date" class="form-control date-picker" type="text" />
          </div>
          <div class="mb-1">
            <label class="form-label" for="payment-method">Payment Method</label>
            <select class="form-select" id="payment-method">
              <option value="" selected disabled>Select payment method</option>
              <option value="Cash">Cash</option>
              <option value="Bank Transfer">Bank Transfer</option>
              <option value="Debit">Debit</option>
              <option value="Credit">Credit</option>
              <option value="Paypal">Paypal</option>
            </select>
          </div>
          <div class="mb-1">
            <label class="form-label" for="payment-note">Internal Payment Note</label>
            <textarea class="form-control" id="payment-note" rows="5" placeholder="Internal Payment Note"></textarea>
          </div>
          <div class="d-flex flex-wrap mb-0">
            <button type="button" class="btn btn-primary me-1" data-bs-dismiss="modal">Send</button>
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- /Add Payment Sidebar -->
@endsection

@section('vendor-script')
<script src="{{asset('vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
<script src="{{asset('vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('js/scripts/pages/app-invoice.js')}}"></script>
<script src="{{ asset(mix('js/scripts/pages/app-ecommerce-details.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/forms/form-number-input.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>
@endsection
