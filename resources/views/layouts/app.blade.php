<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.url') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles

    <!-- CSRF Token -->
    <meta name="_token" content="{{ csrf_token() }}">

    <!-- end plugin css -->

    @stack('plugin-styles')

    @stack('style')
</head>
<body data-base-url="{{url('/')}}">

<div class="main-wrapper" id="app">
    @include('layouts.header')
    <div class="page-wrapper">
        <div class="page-content">

            @yield('breadcrumbs')

            @if ($slot ?? null)
                {{ $slot }}
            @else
                @yield('content')
            @endif
        </div>
        @include('layouts.footer')
    </div>
</div>

@livewireScripts

@stack('plugin-scripts')

@stack('custom-scripts')

</body>
</html>
