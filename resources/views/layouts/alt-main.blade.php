<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>altGaming | Videos, words and thoughts about gaming</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
  @yield('content')
</body>

<!--<script src="https://js.stripe.com/v3/"></script>-->
<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

</html>
