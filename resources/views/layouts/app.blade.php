<!DOCTYPE html>
<html lang="id">
<head>
    @include('partials.head')
</head>
<body>
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="lds-ellipsis">
            <div></div><div></div><div></div><div></div>
        </div>
    </div>

    @include('partials.header')

    @yield('content')

    @include('partials.footer')

    @include('partials.scripts')
</body>
</html>
