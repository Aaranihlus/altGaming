<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>altGaming | Videos, words and thoughts about gaming</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body style="padding-bottom: 5vh;">

  <div class="container-fluid g-0 m-0" id="header" style="border-bottom: 2px solid #ffc107;">
    @include('layouts.nav')
  </div>

  @if( !request()->is('/') )
    <div class="container m-4"></div>
  @endif

  @yield('content')

  @include('layouts.mobile-nav')

  @include('layouts.social-panel')

  <!--<div class="container-fluid g-0 bg-alt-yellow flex-y" id="footer" style="max-height: 5vh; height: 5vh; text-align: center; justify-content: center; position: fixed; right: 0; bottom: 0; left: 0;">
    <p class="g-0 mb-0">©2022 altGaming Ltd</p>
  </div>-->

</body>

<script type="text/javascript" src="{{ asset('js/app.js') }}"></script>

<script>
if ( $('#editor').length > 0 ) {
  CKSource.Editor.create( document.querySelector( '#editor' ), {

    mediaEmbed: {
      previewsInData: true
    },

    alignment: {
      options: [ 'left', 'right', 'center', 'justify' ]
    },

    ckfinder: {
      uploadUrl: '{{ route('ckeditor.upload').'?_token='.csrf_token() }}'
    },

    removePlugins: ['Title']

  }).then( editor => {
    console.log( editor );
  }).catch( error => {
    console.error( error );
  })
}
</script>

@if(request()->is('cart'))
  <script src="https://www.paypal.com/sdk/js?client-id={{ $client_id }}&components=buttons,hosted-fields&disable-funding=card&enable-funding=paylater" data-client-token="{{ $client_token }}"></script>
  <script type="text/javascript" src="{{ asset('js/paypal.js') }}"></script>
@endif

</html>
