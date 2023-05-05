<!doctype html>
<html lang="en">


<head>

        <meta charset="utf-8" />
        <title> Admin Dashboard - @yield('title', '') </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesbrand" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        <link href="/vendors/assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Css -->
        <link href="/vendors/assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="/vendors/assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="/vendors/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="/vendors/assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/7.0.96/css/materialdesignicons.css">

    </head>

    
    <body>

    <!-- <body data-layout="horizontal" data-topbar="colored"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            @include('layouts.header-a')
            
            <!-- ========== Left Sidebar Start ========== -->
              @include('layouts.leftsidebar')
            <!-- Left Sidebar End -->

            

            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <div class="page-content">
                    @yield('content')
                </div>    
                <!-- End Page-content -->


                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © Minible.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Crafted with <i class="mdi mdi-heart text-danger"></i> by <a href="https://themesbrand.com/" target="_blank" class="text-reset">Themesbrand</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        

        <!-- Right Sidebar -->
          @include('layouts.right')
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- JAVASCRIPT -->
        <script src="/vendors/assets/libs/jquery/jquery.min.js"></script>
        <script src="/vendors/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/vendors/assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="/vendors/assets/libs/simplebar/simplebar.min.js"></script>
        <script src="/vendors/assets/libs/node-waves/waves.min.js"></script>
        <script src="/vendors/assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
        <script src="/vendors/assets/libs/jquery.counterup/jquery.counterup.min.js"></script>

        <!-- apexcharts -->
        <script src="/vendors/assets/libs/apexcharts/apexcharts.min.js"></script>

        <script src="/vendors/assets/js/pages/dashboard.init.js"></script>
        <!-- Ion Range Slider-->
        <script src="/vendors/assets/libs/ion-rangeslider/js/ion.rangeSlider.min.js"></script>
         <!-- select 2 plugin -->
         <script src="/vendors/assets/libs/select2/js/select2.min.js"></script>

         <!-- dropzone plugin -->
         <script src="/vendors/assets/libs/dropzone/min/dropzone.min.js"></script>
 
         <!-- init js -->
         <script src="/vendors/assets/js/pages/ecommerce-add-product.init.js"></script>
        <!-- init js -->
        <script src="/vendors/assets/js/pages/product-filter-range.init.js"></script>
        <!-- App js -->
        <script src="/vendors/assets/js/app.js"></script>
       @include('layouts.message')
       @include('sweetalert::alert')

    </body>

</html>