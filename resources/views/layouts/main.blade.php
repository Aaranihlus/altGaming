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

  <div class="container-fluid g-0 mb-4" id="header">
    @include('layouts.nav')
  </div>

  @yield('content')

  <!--<div style="position: fixed; top: 90%; left: 50%; z-index: 10000; transform: translate(-50%, -50%); background: rgba(247, 201, 241, 0.4); padding: .5rem 1rem; border-radius: 30px;">
    <div class="d-block d-sm-none">Extra Small (xs)</div>
    <div class="d-none d-sm-block d-md-none">Small (sm)</div>
    <div class="d-none d-md-block d-lg-none">Medium (md)</div>
    <div class="d-none d-lg-block d-xl-none">Large (lg)</div>
    <div class="d-none d-xl-block" >X-Large (xl)</div>
  </div>-->

  @include('layouts.mobile-nav')

  <!--<div class="container-fluid g-0 bg-alt-yellow flex-y" id="footer" style="max-height: 5vh; height: 5vh; text-align: center; justify-content: center; position: fixed; right: 0; bottom: 0; left: 0;">
    <p class="g-0 mb-0">©2022 altGaming Ltd</p>
  </div>-->

</body>

<!--<script src="https://js.stripe.com/v3/"></script>-->
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

</html>
