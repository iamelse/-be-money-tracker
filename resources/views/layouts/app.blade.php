<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
      {{ $title ?? env('APP_NAME') }}
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  </head>

  <body
    x-data="{ page: 'ecommerce', 'loaded': true, 'darkMode': true, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark text-bodydark bg-boxdark-2': darkMode === true}"
  >
    <!-- ===== Preloader Start ===== -->
    @include('partials.preloader')
    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <div class="flex h-screen overflow-hidden">
      <!-- ===== Sidebar Start ===== -->
      @include('partials.sidebar')
      <!-- ===== Sidebar End ===== -->

      @yield('content')
    </div>
    <!-- ===== Page Wrapper End ===== -->
  </body>
</html>