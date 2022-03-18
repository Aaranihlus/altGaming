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

  @include('layouts.mobile-nav')

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
  <script src="https://www.paypal.com/sdk/js?components=buttons,hosted-fields&disable-funding=card&enable-funding=paylater&client-id={{ $client_id }}"
  data-client-token="{{ $client_token }}">
</script>

<script>
paypal
  .Buttons({
    // Sets up the transaction when a payment button is clicked
    createOrder: function (data, actions) {
      return fetch("/api/orders", {
        method: "post",
        // use the "body" param to optionally pass additional order information
        // like product ids or amount
      })
        .then((response) => response.json())
        .then((order) => order.id);
    },
    // Finalize the transaction after payer approval
    onApprove: function (data, actions) {
      return fetch(`/api/orders/${data.orderID}/capture`, {
        method: "post",
      })
        .then((response) => response.json())
        .then((orderData) => {
          // Successful capture! For dev/demo purposes:
          console.log( "Capture result", orderData, JSON.stringify(orderData, null, 2));
          var transaction = orderData.purchase_units[0].payments.captures[0];
          alert(`Transaction ${transaction.status}: ${transaction.id}

            See console for all available details
          `);
          // When ready to go live, remove the alert and show a success message within this page. For example:
          // var element = document.getElementById('paypal-button-container');
          // element.innerHTML = '<h3>Thank you for your payment!</h3>';
          // Or go to another URL:  actions.redirect('thank_you.html');
        });
    },
  })
  .render("#paypal-container");
</script>





@endif

</html>
