<!DOCTYPE html>
<html>
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
    <div class="page-wrapper full-page">
      @yield('content')
    </div>
  </div>

  <!-- plugin js -->
  @stack('plugin-scripts')
  <!-- end plugin js -->


  @stack('custom-scripts')

  @livewireScripts
</body>
</html>
