<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="csrf-token" content="{{ csrf_token() }}">

    <title>CROWNS WEB</title>
		
		<!-- Favicon -->
		<link rel="icon" href="{{ asset('assets/img/brand/crowns.png') }}" type="image/png">
		<!-- Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
		<!-- Icons -->
		<link rel="stylesheet" href="{{ asset('assets/vendor/nucleo/css/nucleo.css') }}" type="text/css">
		<link rel="stylesheet" href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}" type="text/css">
		<!-- Styles -->
		<link rel="stylesheet" href="{{ asset('css/app.css') }}">
		<!-- Argon CSS -->
		<link rel="stylesheet" href="{{ asset('assets/css/argon.css?v=1.2.0') }}" type="text/css">
		<!-- Scripts -->
		<script src="{{ asset('js/app.js') }}" defer></script>
</head>

<body class="font-sans antialiased">
	<!-- Sidenav -->
  <!-- sidenav -->
  <nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
      <!-- Brand -->
      <div class="sidenav-header  align-items-center">
        <a class="navbar-brand" href="javascript:void(0)">
          <img src="{{ asset('assets/img/brand/blue.png') }}" class="navbar-brand-img" alt="...">
        </a>
      </div>
      <div class="navbar-inner">
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
          <!-- Nav items -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link active" href="{{ route('dashboard') }}">
                <i class="ni ni-tv-2 text-primary"></i>
                <span class="nav-link-text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('profile') }}">
                <i class="ni ni-single-02 text-yellow"></i>
                <span class="nav-link-text">Profile</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('manage-akun') }}">
                <i class="ni ni-bullet-list-67 text-default"></i>
                <span class="nav-link-text">Manage Akun</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('katalog') }}">
              <i class="ni text-primary justify-content-center"><img src="{{ asset('assets/img/icons/common/clothes.svg') }}" class="ni text-primary" style="width: 15px; height: 15px;"></i>
                <span class="nav-link-text">Katalog</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('pesanan') }}">
                <i class="ni ni-credit-card text-info"></i>
                <span class="nav-link-text">Pesanan</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!-- End of Sidenav -->
  <!-- Main content -->
	
  <div class="main-content" id="panel">
    @include('components.top-nav')
	  @yield('content')
  </div>
	<!-- Page Content -->
</body>
<!-- Core -->

<script src="{{ asset('assets/vendor/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/vendor/js-cookie/js.cookie.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
<!-- Optional JS -->
<script src="{{ asset('assets/vendor/chart.js/dist/Chart.min.js') }}"></script>
<script src="{{ asset('assets/vendor/chart.js/dist/Chart.extension.js') }}"></script>
<!-- Argon JS -->
<script src="{{ asset('assets/js/argon.js?v=1.2.0') }}"></script>
@yield('script')
</body>

</html>
