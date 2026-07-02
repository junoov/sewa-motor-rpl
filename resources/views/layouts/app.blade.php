<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'MotoRent')</title>
  <link rel="icon" href="{{ asset('assets/logo-motorent.svg') }}" type="image/svg+xml">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
  @vite('resources/css/app.css')
  @stack('head')
</head>
<body>
  @hasSection('pageHeader')
    @yield('pageHeader')
  @else
    @include('partials.site-header')
  @endif

  <main>
    @yield('content')
  </main>

  @stack('scripts')
</body>
</html>


