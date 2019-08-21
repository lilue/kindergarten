<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>@yield('title', '湛江众拓信息科技有限公司') - {{ config('app.name') }}</title>

  <!-- Styles -->
  @section('style')
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  @show

</head>

<body>
  <div id="app" class="{{ route_class() }}-page">

    @include('layouts._header')

    <div class="container">

      @include('shared._messages')

      @yield('content')

    </div>

    @include('layouts._footer')
  </div>

  <!-- Scripts -->
  @section('script')
  <script src="{{ mix('js/app.js') }}"></script>
  @show
</body>

</html>