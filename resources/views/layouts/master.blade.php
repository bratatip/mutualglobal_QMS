<!doctype html>
<html>

    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
            content="width=device-width, initial-scale=1.0">
        @include('layouts.js_cdn')
        @vite('resources/css/app.css')
        {{-- @vite('resources/css/breadcrumb.css') --}}

    </head>

    <body class="font-[Poppins] bg-[#fff]  to- min-h-screen flex flex-col overflow-x-hidden">

        @if (auth()->user()->hasRole('admin'))
            @include('layouts.admin_header')
        @elseif(auth()->user()->hasRole('employee'))
            @include('layouts.employee_header')
        @endif

        <main class="flex-grow">
            @yield('content')
        </main>

        @include('layouts.footer')
        @include('layouts.jscripts')
    </body>

</html>
