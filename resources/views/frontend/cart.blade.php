@extends('layouts.main')
@section('head')
   @include('partials.subheader')
@endsection
@section('content')

<main>

    <!-- breadcrumb area start -->
    <section class="breadcrumb__area include-bg pt-95 pb-50">
       <div class="container">
          <div class="row">
             <div class="col-xxl-12">
                <div class="breadcrumb__content p-relative z-index-1">
                   <h3 class="breadcrumb__title">Shopping Cart</h3>
                   <div class="breadcrumb__list">
                      <span><a href="#">Home</a></span>
                      <span>Shopping Cart</span>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </section>
    <!-- breadcrumb area end -->

    <!-- cart area start -->
    <section class="tp-cart-area pb-120">
       <div class="container">
          <div class="row">
             <div class="col-xl-9 col-lg-8">
                <div class="tp-cart-list mb-25 mr-30">
                   <table class="table">
                      <thead>
                        <tr>
                          <th colspan="2" class="tp-cart-header-product">Product</th>
                          <th class="tp-cart-header-price">Price</th>
                          <th class="tp-cart-header-quantity">Quantity</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tbody>

                             @foreach ($cart as $item)
                              {{-- @php $totalprice = 0; @endphp --}}
                                 <tr class="ptoduct_data">
                                       <!-- img -->
                                       <td class="tp-cart-img">
                                          <a href="product-details.html"> <img src="{{ asset('storage/product/'.$item->product->cover_image) }}" alt=""></a>
                                       </td>
                                       <!-- title -->
                                       <td class="tp-cart-title"><a href="product-details.html">{{ $item->product->name }}</a></td>
                                       <!-- price -->
                                       <td class="tp-cart-price"><span>${{  $item->product->price }}</span></td>
                                       <!-- quantity -->
                                       <td class="tp-cart-quantity">
                                       <div class="tp-product-quantity mt-10 mb-10">
                                                <form action="{{ url('cart/' . $item->id . '/decrement') }}" method="post">
                                                    @csrf
                                                    <button type="submit" class="">
                                                        <span class="tp-cart-minus  ">
                                                           <svg width="10" height="2" viewBox="0 0 10 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                              <path d="M1 1H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                           </svg>
                                                        </span>
                                                    </button>
                                                </form>
                                                {{-- <input type="hidden" class="prod_id" value="{{ $item->product_id }}"> --}}
                                             <input class="tp-cart-input" name="quantity" class="qu-input" type="text" value="{{ $item->quantity }}">
                                             <form action="{{ url('cart/' . $item->id . '/increment') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="">
                                                    <span class="tp-cart-plus  ">
                                                       <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                          <path d="M5 1V9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                          <path d="M1 5H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                       </svg>
                                                    </span>
                                                </button>
                                             </form>
                                       </div>
                                       </td>
                                       <!-- action -->
                                       <td class="tp-cart-action">
                                        <form action="{{ route('cart.delete', $item->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="tp-cart-action-btn">
                                                <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                   <path fill-rule="evenodd" clip-rule="evenodd" d="M9.53033 1.53033C9.82322 1.23744 9.82322 0.762563 9.53033 0.46967C9.23744 0.176777 8.76256 0.176777 8.46967 0.46967L5 3.93934L1.53033 0.46967C1.23744 0.176777 0.762563 0.176777 0.46967 0.46967C0.176777 0.762563 0.176777 1.23744 0.46967 1.53033L3.93934 5L0.46967 8.46967C0.176777 8.76256 0.176777 9.23744 0.46967 9.53033C0.762563 9.82322 1.23744 9.82322 1.53033 9.53033L5 6.06066L8.46967 9.53033C8.76256 9.82322 9.23744 9.82322 9.53033 9.53033C9.82322 9.23744 9.82322 8.76256 9.53033 8.46967L6.06066 5L9.53033 1.53033Z" fill="currentColor"/>
                                                </svg>
                                                <span>Remove</span>
                                            </button>
                                        </form>
                                       </td>
                                 </tr>
                              {{-- @php  $totalprice += $item->product->price * $item->quantity;  @endphp --}}
                             @endforeach

                      </tbody>
                    </table>
                </div>
                <div class="tp-cart-bottom">
                   <div class="row align-items-end">
                      <div class="col-xl-6 col-md-8">
                         {{-- <div class="tp-cart-coupon">
                            <form action="" method="POST">

                               <div class="tp-cart-coupon-input-box">
                                  <label>Coupon Code:</label>
                                  <div class="tp-cart-coupon-input d-flex align-items-center">
                                     <input id="coupon_code" type="text"  name="coupon_code" value="{{ old('coupon_code') }}" placeholder="Enter Coupon Code">
                                     <button type="submit">Apply</button>
                                  </div>
                                  @error('coupon_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                               </div>
                            </form>
                         </div> --}}
                      </div>
                      <div class="col-xl-6 col-md-4">
                         <div class="tp-cart-update text-md-end">
                            <a href="/shop" class="tp-cart-update-btn">Continue  Shopping</a>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
             <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="tp-cart-checkout-wrapper">
                   <div class="tp-cart-checkout-top d-flex align-items-center justify-content-between">
                      <span class="tp-cart-checkout-top-title">Subtotal</span>
                      <span class="tp-cart-checkout-top-price">$742</span>
                   </div>
                   <div class="tp-cart-checkout-shipping">
                      <h4 class="tp-cart-checkout-shipping-title">Shipping</h4>

                      <div class="tp-cart-checkout-shipping-option-wrapper">
                         {{-- <div class="tp-cart-checkout-shipping-option">
                            <input id="flat_rate" type="radio" name="shipping">
                            <label for="flat_rate">Flat rate: <span>$20.00</span></label>
                         </div>
                         <div class="tp-cart-checkout-shipping-option">
                            <input id="local_pickup" type="radio" name="shipping">
                            <label for="local_pickup">Local pickup: <span> $25.00</span></label>
                         </div> --}}
                         <div class="tp-cart-checkout-shipping-option">
                            <input id="free_shipping" type="radio" name="shipping">
                            <label for="free_shipping">Free shipping</label>
                         </div>
                      </div>
                   </div>
                   <div class="tp-cart-checkout-total d-flex align-items-center justify-content-between">
                      <span>Total</span>
                      <span>${{  $totalprice }}</span>
                   </div>
                   <div class="tp-cart-checkout-proceed">
                      <a href="/checkout" class="tp-cart-checkout-btn w-100">Proceed to Checkout</a>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </section>
    <!-- cart area end -->

 </main>
@endsection

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {

        // increment product quantity when + button is clicked
        $('.increment-btn').on('click', function(e) {
            e.preventDefault();

            let inc_value = $('.quantity-input').val();
            let value = parseInt(inc_value, 10);
            value = isNaN(value) ? 0 : value;

            if(value < 100) {
                value++;
                $('.quantity-input').val(value);
            }
        });

        // decrement product quantity when - button is clicked
        $('.decrement-btn').on('click', function(e) {
            e.preventDefault();

            let dec_value = $('.quantity-input').val();
            let value = parseInt(dec_value, 10);

            value = isNaN(value) ? 0 : value;
            if(value > 1) {
                value--;
                $('.quantity-input').val(value);
            }
        });
    });
</script>
{{-- <script>
    $(document).ready(function (){
    $('.increment-btn').click(function (e) {
        e.preventDefault();
        var inc_value = $('.quantity-input');
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value < 10) {
            value++;
            $('.quantity-input').val(value);
        }
    });
    $('.decrement-btn').click(function (e) {
        e.preventDefault();
        var dec_value = $('.quantity-input');
        var value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;
        if (value > 1) {
            value--;
            $('.quantity-input').val(value);
        }
    });
});
</script> --}}
@endsection
