<!DOCTYPE html>
<html lang="zxx">
  <head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="">
      <meta name="keyword" content="">
      <meta name="author" content="theme_ocean">
      <!--! The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags !-->
      <!--! BEGIN: Apps Title-->
      <title>Login</title>
      <!--! END:  Apps Title-->
      <!--! BEGIN: Favicon-->
      <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/favicon.ico') }}">
      <!--! END: Favicon-->
      <!--! BEGIN: Bootstrap CSS-->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/bootstrap.min.css') }}">
      <!--! END: Bootstrap CSS-->
      <!--! BEGIN: Vendors CSS-->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/vendors.min.css') }}">
      
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/dataTables.bs5.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/select2.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/select2-theme.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/tagify-data.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/quill.min.css') }}">
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/css/datepicker.min.css') }}">
      <!--! END: Vendors CSS-->
      <!--! BEGIN: Custom CSS-->
      <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/theme.min.css') }}">
      <!--! END: Custom CSS-->
      <!--! HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries !-->
      <!--! WARNING: Respond.js doesn"t work if you view the page via file: !-->
      <!--[if lt IE 9]>
        <script src="{{ asset('assets/js/html5shiv.min.js') }}"></script>
        <script src="{{ asset('assets/js/respond.min.js') }}"></script>
      <![endif]-->
      <!--! END: Custom CSS-->
      <style>
        .nxl-container .nxl-content .main-content {
            
            min-height: calc(100vh - 225px);
        }
      </style>
  </head>
    <body>
        @include('admin.partials.nav-bar')
        @include('admin.partials.header')
        <main class="nxl-container">
            @yield('content')
            <!-- [ Footer ] start -->
            <footer class="footer">
                <p class="fs-11 text-muted fw-medium text-uppercase mb-0 copyright">
                    <span>Copyright ©</span>
                    <script>
                        document.write(new Date().getFullYear());
                    </script>
                </p>
                <p><span>By: <a target="_blank" href="https://wrapbootstrap.com/user/theme_ocean" target="_blank">theme_ocean</a></span> • <span>Distributed by: <a target="_blank" href="https://themewagon.com" target="_blank">ThemeWagon</a></span></p>
                <div class="d-flex align-items-center gap-4">
                    <a href="javascript:void(0);" class="fs-11 fw-semibold text-uppercase">Help</a>
                    <a href="javascript:void(0);" class="fs-11 fw-semibold text-uppercase">Terms</a>
                    <a href="javascript:void(0);" class="fs-11 fw-semibold text-uppercase">Privacy</a>
                </div>
            </footer>
            <!-- [ Footer ] end -->
        </main>
        
        @include('admin.partials.footer')
    </body>
</html>