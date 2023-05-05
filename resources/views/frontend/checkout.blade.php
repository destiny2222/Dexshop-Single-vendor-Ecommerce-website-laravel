@extends('layouts.main')
@section('head')
   @include('partials.subheader')
@endsection
@section('content')

<main>

    <!-- breadcrumb area start -->
    <section class="breadcrumb__area include-bg pt-95 pb-50" data-bg-color="#EFF1F5">
       <div class="container">
          <div class="row">
             <div class="col-xxl-12">
                <div class="breadcrumb__content p-relative z-index-1">
                   <h3 class="breadcrumb__title">Checkout</h3>
                   <div class="breadcrumb__list">
                      <span><a href="#">Home</a></span>
                      <span>Checkout</span>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </section>
    <!-- breadcrumb area end -->

    <!-- checkout area start -->
    <section class="tp-checkout-area pb-120" data-bg-color="#EFF1F5">
       <div class="container">
        <form action="{{ route('checkout.submit') }}" id="paymentForm" method="POST">
            @csrf
          <div class="row">

             <div class="col-lg-7">
                <div class="tp-checkout-bill-area">
                   <h3 class="tp-checkout-bill-title">Billing Details</h3>

                   <div class="tp-checkout-bill-form">

                         <div class="tp-checkout-bill-inner">
                            <div class="row">
                               <div class="col-md-6">
                                  <div class="tp-checkout-input">
                                     <label>First Name <span>*</span></label>
                                     <input type="text" name="name" required placeholder="First Name">
                                  </div>
                               </div>

                               <div class="col-md-6">
                                  <div class="tp-checkout-input">
                                     <label>Last Name <span>*</span></label>
                                     <input type="text" name="lastname" value="{{ old('lastname') }}" required placeholder="Last Name">
                                  </div>
                               </div>
                               <div class="col-md-12">
                                <div class="tp-checkout-input">
                                   <label>Email address <span>*</span></label>
                                   <input type="email" name="email" id="email-address" value="{{ old('email') }}" required>
                                </div>
                             </div>
                               {{-- <div class="col-md-12">
                                  <div class="tp-checkout-input">
                                     <label>Company name (optional)</label>
                                     <input type="text" placeholder="Example LTD.">
                                  </div>
                               </div> --}}
                               {{-- <div class="col-md-12">
                                  <div class="tp-checkout-input">
                                     <label>Country / Region </label>
                                     <input type="text" placeholder="United States (US)">
                                  </div>
                               </div> --}}
                               <div class="col-md-12">
                                  <div class="tp-checkout-input">
                                     <label>Street address</label>
                                     <input type="text" name="address" required placeholder="House number and street name">
                                  </div>

                                  {{-- <div class="tp-checkout-input">
                                     <input type="text" placeholder="Apartment, suite, unit, etc. (optional)">
                                  </div> --}}
                               </div>
                               {{-- <div class="col-md-12">
                                  <div class="tp-checkout-input">
                                     <label>Town / City</label>
                                     <input type="text" placeholder="">
                                  </div>
                               </div> --}}
                                <div class="col-md-6">
                                  {{-- <div class="tp-checkout-input">
                                     <label>State / County</label>
                                     <select id="country" name="country" class="form-control">
                                        @foreach (\Webpatser\Countries\Countries::all() as $country)
                                            <option value="{{ $country->name }}">
                                                {{ $country->flag }} {{ $country->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                  </div> --}}
                               </div>
                               {{-- <div class="col-md-6">
                                  <div class="tp-checkout-input">
                                     <label>Postcode ZIP</label>
                                     <input type="text" placeholder="">
                                  </div>
                               </div> --}}
                               <div class="col-md-12">
                                  <div class="tp-checkout-input">
                                     <label>Phone <span>*</span></label>
                                     <input type="tel" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" required>
                                  </div>
                               </div>
                               <input type="hidden" name="reference" value="{{ Paystack::genTranxRef() }}">
                               <input type="hidden" name="currency" value="NGN">
                               {{-- <div class="col-md-12">
                                  <div class="tp-checkout-input">
                                     <label>Order notes (optional)</label>
                                     <textarea placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                  </div>
                               </div> --}}
                            </div>
                         </div>

                   </div>
                </div>
             </div>
             <div class="col-lg-5">
                <!-- checkout place order -->
                <div class=" mb-3 tp-checkout-place white-bg">
                   <h3 class="tp-checkout-place-title">Your Order</h3>

                   <div class="tp-order-info-list">
                      <ul>

                         <!-- header -->
                         <li class="tp-order-info-list-header">
                            <h4>Product</h4>
                            <h4>Total</h4>
                         </li>

                         <!-- item list -->
                         @foreach ($productItem as $item)
                            <li class="tp-order-info-list-desc">
                                <p>{{  $item->product->name }} <span> x {{  $item->quantity }}</span></p>
                                <span>${{  $item->product->price }}</span>
                            </li>
                         @endforeach

                         <!-- subtotal -->
                         <li class="tp-order-info-list-subtotal">
                            <span>Subtotal</span>
                            <span>${{ $totalprice }}</span>
                         </li>

                         <!-- shipping -->
                         <li class="tp-order-info-list-shipping">
                            <span>Shipping</span>
                            <div class="tp-order-info-list-shipping-item d-flex flex-column align-items-end">
                               {{-- <span>
                                  <input id="flat_rate" type="radio" value="20" name="shipping_fee">
                                  <label for="flat_rate">Flat rate: <span>$20.00</span></label>
                               </span> --}}
                               <span>
                                  <input id="free_shipping" type="radio" name="shipping_fee">
                                  <label for="free_shipping">Free shipping</label>
                               </span>
                            </div>
                         </li>

                         <!-- total -->
                         <li class="tp-order-info-list-total">
                            <span>Total</span>
                            <span>${{ $total }}</span>
                         </li>
                      </ul>
                   </div>
                   <div class="tp-checkout-agree">
                      <div class="tp-checkout-option">
                         <input id="read_all" type="checkbox">
                         <label for="read_all">I have read and agree to the website.</label>
                      </div>
                   </div>
                   <div class="tp-checkout-btn-wrapper">
                      <button type="submit" class="tp-checkout-btn w-100 text-white">Place Order</button>
                   </div>
                </div>
             </div>
          </div>
        </form>
          {{-- <div class="row">
                <div class="col-lg-6 col-12">
                    <div class="tp-checkout-verify">
                        <div class="tp-checkout-verify-item">
                             <p class="tp-checkout-verify-reveal">
                              Have a coupon?
                              <button type="button" class="tp-checkout-coupon-form-reveal-btn">Click here to enter your code</button>
                             </p>

                           <div id="tpCheckoutCouponForm" class="tp-return-customer">
                                <form action="{{ route('apply-coupon') }}" method="post">
                                    @csrf

                                    <div class="tp-return-customer-input">
                                        <label>Coupon Code :</label>
                                        <input type="text" name="coupon_code" class="@error('coupon_code') is-invalid  @enderror" value="{{ old('coupon_code') }}" placeholder="Enter Coupon Code">
                                    </div>
                                    <button type="submit" class="tp-return-customer-btn tp-checkout-btn">Apply</button>
                                </form>
                                @error('coupon_code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           </div>
                        </div>
                    </div>
                </div>
          </div> --}}
       </div>
    </section>
    <!-- checkout area end -->


 </main>

{{-- @include('partials.script') --}}
@endsection
