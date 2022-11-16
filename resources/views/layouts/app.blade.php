<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />

        <title>@yield('title-page')</title>
        <meta content="" name="description" />
        <meta content="" name="keywords" />

        @stack('style-atas')
        @include('includes.style')
        @stack('style-bawah')
        <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
    </head>

    <body>
        <!-- ======= Header ======= -->
        @include('includes.header')
        <!-- End Header -->

        <!-- ======= Sidebar ======= -->
        
        @include('includes.sidebar')
        
        
        <!-- End Sidebar-->

        <main id="main" class="main">
           @yield('content')
        </main>
        <!-- End #main -->

        <!-- ======= Footer ======= -->
        @include('includes.footer')
        <!-- End Footer -->

        <a
            href="#"
            class="back-to-top d-flex align-items-center justify-content-center"
            ><i class="bi bi-arrow-up-short"></i
        ></a>

      @stack('script-atas')  
      @include('includes.script')
      @stack('script-bawah')  
    </body>
</html>
