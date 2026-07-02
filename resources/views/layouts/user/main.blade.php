<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="author" content="Sahabat Group">
    <meta name="description" content="Dashboard Freelance - Sahabat Group">
    <meta name="keywords" content="freelance, umkm, dashboard">
    <link rel="shortcut icon" href="{{ asset('assets/image/logo.png') }}">
    <title>Dashboard • Sahabat Freelance</title>

    {{-- Modern Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=IBM+Plex+Sans:wght@400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    @include('layouts.user.style')
</head>

<body>
    <a class="skip-link" href="#main-content">Lewati ke konten utama</a>
    <div class="dashboard-wrapper">
        @include('layouts.user.navbar')

        <main class="dashboard-main" id="main-content" tabindex="-1">
            @yield('content')
        </main>

        @include('layouts.user.footer')
    </div>

    @include('layouts.user.script')
    @include('components.toastr')
    @include('sweetalert::alert')
    @stack('scripts')
</body>

</html>
