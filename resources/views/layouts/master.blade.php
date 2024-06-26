<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <title>@yield('title', config('app.name'))</title>
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">
    @include('layouts.js_cdn')
    @vite('resources/css/app.css')
    {{-- @vite('resources/css/breadcrumb.css') --}}

    @stack('third_party_stylesheets')
    @stack('page_css')

</head>

<body class="font-[Poppins] bg-[#fff]  to- min-h-screen flex flex-col overflow-x-hidden">
    @auth
        @if (auth()->user()->hasRole('admin'))
            @include('layouts.admin_header')
        @elseif(auth()->user()->hasRole('employee'))
            @include('layouts.employee_header')
        @endif
    @endauth
    <main class="flex-grow mt-4">
        @yield('content')
    </main>

    @auth
        @include('layouts.footer')
    @endauth
    @include('layouts.jscripts')

    @stack('third_party_scripts')

    @stack('page_scripts')
</body>

</html>
