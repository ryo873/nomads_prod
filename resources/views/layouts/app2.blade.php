<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8" />
    <title>@yield('title')</title>

    @stack('prepend-style')
    @include('includes.style')
    @stack('addon-style')
  </head>
  <body>
    <!-- Header -->

    @include('includes.navbar2')
    @yield('content')
    @include('includes.footer')
    @stack('prepend-script')
    @include('includes.script')
    @stack('addon-script')

  </body>
</html>
