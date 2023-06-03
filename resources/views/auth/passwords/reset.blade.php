{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
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
                      <h3 class="tp-login-title">Reset Passowrd</h3>
                      <p>Enter your email address to request password reset.</p>
                   </div>

                   <div class="tp-login-option">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="tp-login-input-wrapper">
                            <div class="tp-login-input-box">
                               <div class="tp-login-input">
                                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                               </div>
                               <div class="tp-login-input-title">
                                  <label for="email">Your Email</label>
                               </div>
                               @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="tp-login-input-box">
                               <div class="tp-login-input">
                                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                               </div>
                               <div class="tp-login-input-title">
                                  <label for="email">Password</label>
                               </div>
                               @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="tp-login-input-box">
                               <div class="tp-login-input">
                                  <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                               </div>
                               <div class="tp-login-input-title">
                                  <label for="email">{{ __('Confirm Password') }}</label>
                               </div>
                            </div>
                         </div>
                         <div class="tp-login-bottom mb-15">
                            <button type="submit" class="tp-login-btn w-100">Reset password</button>
                         </div>
                      </form>

                   </div>
                </div>
             </div>
          </div>
       </div>
    </section>
    <!-- login area end -->

 </main>
@endsection
