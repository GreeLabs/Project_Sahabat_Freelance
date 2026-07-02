<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport">

    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=IBM+Plex+Sans:wght@400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/templates/admin/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/templates/admin/modules/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/templates/admin/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/templates/admin/css/components.css') }}">
    @vite('resources/css/neo-brutalism.css')

    <title>@yield('title')</title>
</head>

<body>
    <a class="skip-link" href="#main-content">Lewati ke konten utama</a>
    @include('sweetalert::alert')

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            @include('layouts.admin.navbar')
            @include('layouts.admin.sidebar')

            <div id="main-content" tabindex="-1">
                @yield('content')
            </div>

            @include('layouts.admin.footer')
        </div>
    </div>

    @include('layouts.admin.script')
    @include('components.toastr')
</body>
</html>
