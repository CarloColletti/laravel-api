<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  {{-- cdn  --}}
  @yield('cdn')

  <title>{{ env('APP_NAME') }} @yield('title')</title>

  <!-- Vite -->
  @vite(['resources/js/app.js'])
</head>

<body>
  @include('partials._header')

  <main>
    <div class="py-5">
      @yield('content')
    </div>
  </main>

  {{-- footer carino  --}}
  @include('partials._footer')


  @yield('modal')
  @yield('script')
</body>

</html>
