<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Beranda | Jager Bakery')</title>

    <!-- STYLE CSS -->
    <link rel="stylesheet" href="{{ asset('front/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/responsive.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <!-- END STYLE CSS -->
</head>
<body>
    <div class="container">
        @include('frontend.layouts.navbar')
        <div class="container">
        @yield('content')
         <!-- Bootstrap Bundle with Popper -->
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
        </div>
    </div>
    @include('frontend.layouts.footer')
    
    <!-- SCRIPT JS -->
    <script src="{{ asset('front/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!-- END SCRIPT JS -->
    @yield('scripts')
</body>
</html>
