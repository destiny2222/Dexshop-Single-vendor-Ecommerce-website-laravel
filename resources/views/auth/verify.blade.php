@extends('layouts.main')
@section('head')
   @include('partials.subheader')
@endsection
@section('content')

  <main>
    <!-- login area start -->
    <section class="tp-login-area pb-140 p-relative pt-95 z-index-1 fix">
        <div class="tp-login-shape">
           <img class="tp-login-shape-1" src="assets/img/login/login-shape-1.png" alt="">
           <img class="tp-login-shape-2" src="assets/img/login/login-shape-2.png" alt="">
           <img class="tp-login-shape-3" src="assets/img/login/login-shape-3.png" alt="">
           <img class="tp-login-shape-4" src="assets/img/login/login-shape-4.png" alt="">
        </div>
        <div class="container">
           <div class="row justify-content-center">
              <div class="col-xl-6 col-lg-8">
                 <div class="tp-login-wrapper">
                    <div class="tp-login-top text-center mb-30">
                       <h3 class="tp-login-title">{{ __('Verify Your Email Address') }}</h3>
                        @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                                {{ __('A fresh verification link has been sent to your email address.') }}
                            </div>
                        @endif
                    </div>

                    <div class="tp-login-option">
                        <p>{{ __('Before proceeding, please check your email for a verification link.') }}</p>
                        <p>{{ __('If you did not receive the email') }}</p>,
                        <div>
                            <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                                @csrf
                                <button type="submit" class="tp-login-btn w-100">{{ __('click here to request another') }}</button>.
                            </form>
                        </div>

                    </div>
                 </div>
              </div>
           </div>
        </div>
     </section>
     <!-- login area end -->


  </main>
@endsection
