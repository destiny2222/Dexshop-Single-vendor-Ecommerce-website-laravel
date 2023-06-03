
@php
    $cartData = calculateTotalPrice();
    $cart = $cartData['cart'];
    $totalPrice = $cartData['totalPrice'];
@endphp


<div class="cartmini__area tp-all-font-roboto">
    <div class="cartmini__wrapper d-flex justify-content-between flex-column">

            <div class="cartmini__top-wrapper">
                <div class="cartmini__top p-relative">
                    <div class="cartmini__top-title">
                        <h4>Shopping cart</h4>
                    </div>
                    <div class="cartmini__close">
                        <button type="button" class="cartmini__close-btn cartmini-close-btn"><i class="fal fa-times"></i></button>
                    </div>
                </div>
                <div class="cartmini__shipping">
                    <p>
                        @if ($totalPrice >= 50)
                            Free Shipping for all orders over <span>$50</span>
                        @else
                            Add <span>${{ 50 - $totalPrice }}</span> more for Free Shipping
                        @endif
                    </p>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: {{ ($totalPrice / 50) * 100 }}%" aria-valuenow="{{ ($totalPrice / 50) * 100 }}" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div>

                </div>
                @if ($cart->isEmpty())
                    <!-- if no item in cart -->
                    <div class="cartmini__empty text-center mb-3">
                        <img src="assets/img/product/cartmini/empty-cart.png" alt="">
                        <p>Your Cart is empty</p>
                        <a href="/shop" class="tp-btn">Go to Shop</a>
                    </div>
                @else
                    @foreach ($cart as $carted)
                        <div class="cartmini__widget">
                            <div class="cartmini__widget-item">
                                <div class="cartmini__thumb">
                                    <a href="/cart">
                                        <img src="{{   asset('storage/product/'.$carted->product->cover_image)  }}" alt="{{ \Str::limit($carted->product->name, 20) }}">
                                    </a>
                                </div>
                                <div class="cartmini__content">
                                    <h5 class="cartmini__title"><a href="/cart">{{ \Str::limit($carted->product->name, 20) }}</a></h5>
                                    <div class="cartmini__price-wrapper">
                                        <span class="cartmini__price">${{ number_format($carted->product->price, 2) }}</span>
                                        <span class="cartmini__quantity">x{{ $carted->quantity }}</span>
                                    </div>
                                </div>
                                <form action="{{  route('cart.delete', $carted->id) }}" method="post">
                                    @csrf
                                    @method('delete')
                                    <button type="submit">
                                        <a href="" class="cartmini__del"><i class="fa-regular fa-xmark"></i></a>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
            <div class="cartmini__checkout">
                <div class="cartmini__checkout-title mb-30">
                    <h4>Subtotal:</h4>
                    <span>${{ number_format($totalPrice, 2) }}</span>
                </div>
                <div class="cartmini__checkout-btn">
                    <a href="{{  route('cart-home') }}" class="tp-btn mb-10 w-100"> view cart</a>
                    <a href="{{ route('checkout-index') }}" class="tp-btn tp-btn-border w-100"> checkout</a>
                </div>
            </div>

    </div>
</div>
