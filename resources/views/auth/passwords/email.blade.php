@extends('layouts.main')

@section('content')
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
<main>



    <!-- login area start -->
    <section class="tp-login-area pb-140 pt-95 p-relative z-index-1 fix">
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
                   @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                   <div class="tp-login-option">
                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf
                        <div class="tp-login-input-wrapper">
                            <div class="tp-login-input-box">
                               <div class="tp-login-input">
                                  <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
                         </div>
                         <div class="tp-login-bottom mb-15">
                            <button type="submit" class="tp-login-btn w-100">Send Password Reset Link</button>
                         </div>
                      </form>
                      <div class="tp-login-suggetions d-sm-flex align-items-center justify-content-center">
                         <div class="tp-login-forgot">
                            <span>Remeber Passowrd? <a href="/login"> Login</a></span>

                         </div>
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
