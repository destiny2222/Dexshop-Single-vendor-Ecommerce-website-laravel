<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title></title>
    <meta name="keywords" content="solar">
    <meta name="description" content="Learn about the Energy Department&#039;s efforts to advance technologies that drive down the cost of solar energy in Nigerian.">
    <meta name="author" content="p-themes">
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/assets/images/solar/logo.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/assets/images/solar/logo.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/assets/images/solar/logo.png">
    <link rel="manifest" href="/assets/images/solar/logo.png">
    <link rel="mask-icon" href="/assets/images/solar/logo.png" color="#666666">
    <link rel="shortcut icon" href="/assets/images/solar/logo.png">
    <meta name="apple-mobile-web-app-title" content="Green Fusion">
    <meta name="application-name" content="Green Fusion">
    <meta name="msapplication-TileColor" content="#cc9966">
    <meta name="msapplication-config" content="/assets/images/solar/logo.png">
    <meta name="theme-color" content="#ffffff">

          <!-- Place favicon.ico in the root directory -->
          <link rel="shortcut icon" type="image/x-icon" href="assets/img/logo/favicon.png">

          <!-- CSS here -->
          <link rel="stylesheet" href="/assets/css/bootstrap.css">
          <link rel="stylesheet" href="/assets/css/animate.css">
          <link rel="stylesheet" href="/assets/css/swiper-bundle.css">
          <link rel="stylesheet" href="/assets/css/slick.css">
          <link rel="stylesheet" href="/assets/css/magnific-popup.css">
          <link rel="stylesheet" href="/assets/css/font-awesome-pro.css">
          <link rel="stylesheet" href="/assets/css/flaticon_shofy.css">
          <link rel="stylesheet" href="/assets/css/spacing.css">
          <link rel="stylesheet" href="/assets/css/main.css">

          <script  src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

</head>

<body>
         <!-- pre loader area start -->
         <div id="loading">
            <div id="loading-center">
               <div id="loading-center-absolute">
                  <!-- loading content here -->
                  <div class="tp-preloader-content">
                     <div class="tp-preloader-logo">
                        <div class="tp-preloader-circle">
                           {{-- <svg width="190" height="190" viewBox="0 0 380 380" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <circle stroke="#D9D9D9" cx="190" cy="190" r="180" stroke-width="6" stroke-linecap="round"></circle>
                              <circle stroke="red" cx="190" cy="190" r="180" stroke-width="6" stroke-linecap="round"></circle>
                          </svg> --}}
                        </div>
                        {{-- <img src="assets/img/logo/preloader/preloader-icon.svg" alt=""> --}}
                     </div>
                     {{-- <h3 class="tp-preloader-title">Shofy</h3> --}}
                     {{-- <p class="tp-preloader-subtitle">Loading</p> --}}
                  </div>
               </div>
            </div>
         </div>
         <!-- pre loader area end -->

         <!-- back to top start -->
         <div class="back-to-top-wrapper">
            <button id="back_to_top" type="button" class="back-to-top-btn">
               <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M11 6L6 1L1 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
               </svg>
            </button>
         </div>
         <!-- back to top end -->



         <!-- mobile menu area start -->
         @include('partials.mobile-menu')
         <!-- mobile menu area end -->

         <!-- search area start -->
              @include('partials.search')
         <!-- search area end -->

        <!-- cart mini area start -->
            @include('partials.cart-mini')
        <!-- cart mini area end -->

         <!-- header area start -->
              @yield('head')
         <!-- header area end -->




        <main>
             @yield('content')
        </main>

    <!-- footer area start -->
       @include('layouts.footer')
    <!-- footer area end -->

 <script src="/assets/js/vendor/jquery.js"></script>
 <script src="/assets/js/vendor/waypoints.js"></script>
 <script src="/assets/js/bootstrap-bundle.js"></script>
 <script src="/assets/js/meanmenu.js"></script>
 <script src="/assets/js/swiper-bundle.js"></script>
 <script src="/assets/js/slick.js"></script>
 <script src="/assets/js/range-slider.js"></script>
 <script src="/assets/js/magnific-popup.js"></script>
 <script src="/assets/js/nice-select.js"></script>
 <script src="/assets/js/purecounter.js"></script>
 <script src="/assets/js/countdown.js"></script>
 <script src="/assets/js/wow.js"></script>
 <script src="/assets/js/isotope-pkgd.js"></script>
 <script src="/assets/js/imagesloaded-pkgd.js"></script>
 <script src="/assets/js/ajax-form.js"></script>
 <script src="/assets/js/main.js"></script>
 <script src="script.js"></script>
 @yield('scripts')
 @include('layouts.message')
 @include('sweetalert::alert')
</body>
</html>
