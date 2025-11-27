<meta charset="UTF-8">
<meta name="description" content="">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<title>@yield('title', 'E-Mading')</title>
<link rel="icon" href="{{ asset('img/core-img/favicon.ico') }}">
<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/classy-nav.css') }}">
<link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
<link rel="stylesheet" href="{{ asset('css/animate.css') }}">
<link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
/* Remove blue underline from navbar links */
.classy-navbar .classynav ul li a {
    border-bottom: none !important;
    text-decoration: none !important;
}

.classy-navbar .classynav ul li a:hover,
.classy-navbar .classynav ul li a:focus,
.classy-navbar .classynav ul li a.active {
    border-bottom: none !important;
    text-decoration: none !important;
    box-shadow: none !important;
}

.classy-navbar .classynav ul li a::after {
    display: none !important;
}
</style>
