<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    @include('includes.frontend.styles')
    @stack('styles')

    <title>@yield('title')</title>
  </head>
  <body>
    
    <!-- navbar -->
    @include('includes.frontend.navbar')
    <!-- end navbar -->

    @yield('content')

    <!-- footer -->
    @include('includes.frontend.footer')
    <!-- end footer -->


    @include('includes.frontend.scripts')
    @stack('scripts')
  </body>
</html>