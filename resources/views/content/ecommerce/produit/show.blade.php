@extends('layouts/detachedLayoutMaster')
    @section('title', 'Produit')
        @section('vendor-style')
        <!-- Vendor css files -->
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/swiper.min.css')) }}">
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/extensions/toastr.min.css')) }}">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" />
        <script src="{{ asset(mix('vendors/js/extensions/toastr.min.js')) }}"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="{{ asset(mix('vendors/css/pickers/flatpickr/flatpickr.min.css')) }}">    
        <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" id="theme-styles">
        @endsection
        @section('page-style')
        <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-ecommerce.css')) }}">
        <!-- Page css files -->
    <link rel="stylesheet" href="{{ asset(mix('css/base/pages/app-ecommerce-details.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/form-number-input.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('css/base/plugins/extensions/ext-component-toastr.css')) }}">
  <link rel="stylesheet" href="{{ asset(mix('vendors/css/forms/select/select2.min.css')) }}">
  <style>
    .avatar-xxs{height:1.5rem;width:1.5rem}.avatar-xs{height:2rem;width:2rem}.avatar-sm{height:3rem;width:4rem}.avatar-md{height:4.5rem;width:4.5rem}.avatar-lg{height:6rem;width:6rem}.avatar-xl{height:7.5rem;width:7.5rem}.avatar-title{align-items:center;background-color:var(--tb-primary-text-emphasis);color:#fff;display:flex;font-weight:var(--tb-font-weight-medium);height:100%;justify-content:center;width:100%}.avatar-group{padding-left:12px;display:flex;flex-wrap:wrap}.avatar-group .avatar-group-item{margin-left:-12px;border:2px solid var(--tb-border-color);border-radius:50%;transition:all .2s}.avatar-group .avatar-group-item:hover{position:relative;transform:translateY(-2px);z-index:1}
</style>
<link rel="stylesheet" href="{{ asset(mix('css/base/plugins/forms/pickers/form-flat-pickr.css')) }}">
        @endsection



    @section('vendor-script')
        <!-- Vendor js files -->
        <script src="{{ asset(mix('vendors/js/charts/chart.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/pickers/flatpickr/flatpickr.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/forms/select/select2.full.min.js')) }}"></script>
        <script src="{{ asset(mix('vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')) }}"></script>
  <script src="{{ asset(mix('vendors/js/extensions/swiper.min.js')) }}"></script>
    @endsection
    @section('content')

    


    
    @endsection
    @section('page-script')
<!-- Page js files -->
<script src="{{ asset(mix('js/scripts/pages/app-ecommerce-details.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/forms/form-number-input.js')) }}"></script>
<script src="{{ asset(mix('js/scripts/forms/form-select2.js')) }}"></script>

@endsection


