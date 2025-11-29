<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ language_direction() }}" class="theme-fs-sm">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') | {{ app_name() }}</title>
    
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ mix('css/libs.min.css') }}">
  <link rel="stylesheet" href="{{ mix('css/backend.css') }}">
  @if (language_direction() == 'rtl')<link rel="stylesheet" href="{{ asset('css/rtl.css') }}">@endif
  <link rel="stylesheet" href="{{ asset('custom-css/frontend.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"> 
  @stack('after-styles')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.rtl.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Almarai:wght@300;400;700;800&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #f8f8f8;
      font-family: 'Almarai', sans-serif !important;
    }
    .order-summary {
      background: #fff;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }
    .summary-box {
      background: #fff;
      border-radius: 10px;
      padding: 20px;
      width: 90%;
      line-height: 3;
      border: 2px solid #97979745;
    }
    .output{
        width: 50%;
        font-size: 16px;
        font-weight: bold;
    }
    .summary-box h6{
        font-weight: bold;
        font-size: 15px;
    }
    .summary-box div span{
        color: #979797;
    }
    .btn-gold {
      background-color: #c79c3f;
      color: #fff;
      font-weight: 600;
      border: none;
    }
    .btn-gold:hover {
      background-color: #b68d35;
      color: #fff;
    }
    .product-img {
        width: 65px;
        height: 55px;
        border-radius: 10px;
        background-color: #1d1d1d;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .product-img i {
      color: #c79c3f;
      font-size: 22px;
    }
    .table thead th {
      background-color: #CF9233;
      color: white;
      text-align: center;
    }
    .table {
        @if(app()->getLocale() == 'en')
            font-size: 11px;
        @else
            font-size: 14px;
        @endif
        border-collapse: separate;
        border-spacing: 0 25px;
    }
    .table tbody td {
      vertical-align: middle;
      text-align: center;
      background-color: #F8F8F8;
      padding: 20px;
      gap: 25px;
    }
    .coupon-input {
      max-width: 120px;
      margin: 0 auto;
    }
    .cart-empty { color: #888; font-size: 1.3rem; margin: 3rem 0; text-align: center; }
    .prc{
        font-weight: bold;
    }
    .text-start{
        margin: 0 20px 0 0;
        text-align: start !important;
    }
    .btn-delete{
        padding: 10px;
        width: 13%;
        background: #FF473E;
        border-radius: 10px;
        border: none;
    }
    .service-delete{
        border: none;
    }
    .service-delete i{
        color:#979797;
    }
    .co-ser{
        height: 40px;
        border-radius: 10px 0 0 10px;
        padding: 10px;
        color: black;
        font-size: 12px;
        font-weight: bold;
        background: #D9D9D9;
        border: none;
        cursor: pointer;
    }
    .co-ser-disabled{
        height: 40px;
        border-radius: 10px 0 0 10px;
        padding: 10px;
        color: black;
        font-size: 12px;
        font-weight: bold;
        background: #D9D9D9;
        border: none;
        cursor: not-allowed;
        opacity: 0.5
    }
    .co-ser-in{
        width: 100px;
        height: 40px;
        border-radius: 0 11px 11px 0;
        background: white;
        margin: 0 0 0 -4px;
        border: 1px solid #D9D9D9;
    }
    .side-bar{
        display: flex;
        justify-content: end;
    }
    .more-btn{
        border: none;
        color: white;
        width: 70%;
        height: 55px;
        background-color: #CF9233;
        border-radius: 28px;
        display: flex;
        justify-content: center;
        align-items: center;
        position: relative;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    .more-btn::before {
        content: "";
        position: absolute;
        width: 96%;
        height: 80%;
        border: 2px solid white;
        border-radius: 28px;
    }
    a:hover {
        color:white;
    }
    @media (max-width: 576px) {
    .w-100-mob {
        width: 100% !important;
    }
    .table thead th {
        color: #CF9233;
    }
    .prc{
        display:none;
    }    
    tr{
        display: flex;
        flex-direction: column;
    }
    .table {
        font-size: 12px;
    }
    .d-none-mob{
        display:none;
    }
    .btn-delete {
        width: fit-content;
    }
}
  </style>
</head>
<body class="bg-white">
@include('components.frontend.progress-bar')
<div class="position-relative" style="height: 17vh;">
    @include('components.frontend.second-navbar')
</div>
<div class="container py-5">
  <div class="row g-4">
    @if($cartItems->count()) 
    <div class="col-lg-8">
      <div class="order-summary p-3">
        <table class="table align-middle">
          <thead>
            <tr style="background-color: red;">
                <th class="d-none-mob" style="padding:16px 20px;font-weight:bold;">{{ __('messagess.product') }}</th>
                <th class="d-none-mob" style="padding:16px 20px;font-weight:bold;">{{ __('messagess.price') }}</th>
                <th class="d-none-mob" style="padding:16px 20px;font-weight:bold;">{{ __('messagess.discount_coupon') }}</th>
                <th style="padding:16px 20px;font-weight:bold;">{{ __('messagess.final_price') }}</th>
            </tr>
          </thead>
          <tbody>
          @foreach($cartItems as $item)
              @foreach($item->services as $service)
                <tr>
                  <td class="d-flex align-items-center gap-2">
                    <div class="product-img"><i class="bi bi-person"></i></div>
                    <div class="text-start">
                      <strong>{{ $service->service_name }} <i class="bi bi-chevron-left"></i> <i class="bi bi-chevron-left" style="margin: 0 -9px;"></i> <i class="bi bi-chevron-left"></i> {{ $service->service_name }}</strong><br>
                      <small class="text-muted">{{ __('messagess.employee') }}: {{ $service->employee->full_name ?? '-' }}</small>
                    </div>
                  </td>
                  <td class="prc">
                    {{ $service->service_price }} {{ __('messagess.SR')}}
                  </td>
                  <td style="direction: rtl";>
                   @if ($service->coupon_code)
                     <input class="co-ser-in" type="text" value="{{ $service->coupon_code }}" disabled>
                     <button class="co-ser-disabled" disabled>{{ __('messagess.apply_coupon') }}</button>
                   @else
                     <input class="co-ser-in" type="text"  data-service-id="{{ $service->service_id }}" data-booking-id="{{ $item->id }}">
                     <button class="co-ser" onclick="checkCoupon(this)">{{ __('messagess.apply_coupon') }}</button>
                   @endif
                  </td>
                  
                  <td style="position: relative;font-weight: bold;">
                  @if($service->discount_amount && $service->discount_amount > 0)
                   {{ $service->service_price - $service->discount_amount }} {{ __('messagess.SR')}}
                  @else
                   {{ $service->service_price }} {{ __('messagess.SR')}}
                  @endif
                    <form action="{{ route('cart.destroy', $item->id) }}" method="post" style="position: absolute;top: 8px;left: 8px;">
                        @csrf
                        @method('DELETE')
                        <button class="service-delete" title="{{ __('messagess.delete_service') }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                  </td>
                </tr>
              @endforeach
              @foreach($item->products as $product)
                <tr>
                  <td class="d-flex align-items-center gap-2">
                    <div class="product-img"><i class="bi bi-person"></i></div>
                    <div class="text-start">
                      <strong>{{ $product->product_name }}</strong><br>
                      <small class="text-muted">{{ __('booking.qty') }}: {{ $product->product_qty }}</small>
                    </div>
                  </td>
                  <td class="prc">
                    {{ $product->product_price }} {{ __('messagess.SR')}}
                  </td>
                  <!---->
                  <td style="direction: rtl;">
                       @if ($product->discount_value || $product->discount_type)
                         <input type="text" value=" - {{ $product->discount_value }}" disabled>
                         <button disabled>{{ __('messagess.apply_coupon') }}</button>
                       @else
                         <input class="co-ser-in" type="text" style="margin-top: 2px;" data-product-id="{{ $product->product_id }}" data-booking-id="{{ $item->id }}">
                         <button class="co-ser" onclick="">{{ __('messagess.apply_coupon') }}</button>
                       @endif
                   </td>
                  
                  <td style="position: relative;font-weight: bold;">
                  @if($product->discount_value && $product->discount_value > 0)
                   {{ $product->product_price - $product->discount_value }} {{ __('messagess.SR')}}
                  @else
                   {{ $product->product_price }} {{ __('messagess.SR')}}
                  @endif
                    <form action="{{ route('cart.destroy', $item->id) }}" method="post" style="position: absolute;top: 8px;left: 8px;">
                        @csrf
                        @method('DELETE')
                        <button class="service-delete" title="{{ __('messagess.delete_service') }}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                  </td>
                </tr>
              @endforeach
          @endforeach
          </tbody>
        </table>

        <div class="text-end mt-3">
        <form action="{{ route('cart.destroyAll') }}" method="post" >
            @csrf
            @method('DELETE')
            <button class="btn btn-danger btn-delete"><i class="bi bi-trash"></i> {{ __('messages.delete_All') }} </button>
        </form>
        </div>
      </div>
    </div>
    <div class="col-lg-4 side-bar"> 
      <div class="summary-box">
        <h6 class="text-center mb-3 border-bottom pb-4">{{ __('messagess.service_summary') }}</h6>
        <div class="d-flex justify-content-between mb-2">
          <span>{{ __('messagess.services_included') }} :</span><span class="output">{{ $serviceCount }} {{ __('messagess.service') }}</span>
        </div>
        <div class="d-flex justify-content-between mb-2">
          <span>{{ __('messagess.products_included') }} :</span><span class="output">{{ $productCount }} {{ __('messagess.product') }}</span>
        </div>
        <hr>
        <div class="d-flex justify-content-between fw-bold mb-3">
          <span>{{ __('messagess.T_P') }}:</span><span class="output"> {{$finalPrice}} {{ __('messagess.SR') }} </span>
        </div>
        <div class="w-100 d-flex justify-content-center">
        <a href="{{route('paymentMethods')}}" class="more-btn"><i class="bi bi-credit-card"></i>  {{ __('messagess.proceed_to_payment') }}</a>
        </div>
      </div>
    </div>
    @else
        <div class="cart-empty">
            <i class="fas fa-shopping-cart fa-3x mb-3"></i>
            <p>{{ __('messagess.cart_empty_message') }}</p>
            <a href="{{ route('frontend.services') }}" class="btn btn-primary mt-3">
                <i class="fas fa-arrow-right"></i> {{ __('messagess.browse_services') }}
            </a>
        </div>
    @endif
  </div>
</div>
<div class="position-relative" style="height: 17vh;"></div>
<!-- Footer -->
@include('components.frontend.footer')
<!-- Bootstrap Icons -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
    @if (session('success'))
        toastr.success("{{ session('success') }}");
    @endif
    
    @if (session('error'))
        toastr.error("{{ session('error') }}");
    @endif
</script>
<script>
    function checkCoupon(button) {
        const input = button.previousElementSibling;
        const couponCode = input.value.trim();
        const serviceId = input.dataset.serviceId;
        const bookingId = input.dataset.bookingId;
        
        if (!couponCode) {
            toastr.error("{{ __('messagess.enter_coupon_code') }}");
            return;
        }
        
        const url = `/validate-coupon?coupon_code=${encodeURIComponent(couponCode)}&service_id=${serviceId}&booking_id=${bookingId}`;
        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data.valid) { 
                    toastr.success("{{ __('messagess.coupon_applied') }}: " + " " + couponCode);
                    setTimeout(() => {
                        location.reload();
                    }, 700);
                } else {
                    toastr.error("{{ __('messagess.invalid_coupon_for_service') }}"); 
                }
            })
            .catch(() => { toastr.error("{{ __('messagess.error_occurred') }}");  });
    }
</script>
</body>
</html>