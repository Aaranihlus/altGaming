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
  <script src="https://www.paypal.com/sdk/js?client-id={{ $client_id }}&components=buttons,hosted-fields&disable-funding=card&enable-funding=paylater,credit"
  data-client-token="{{ $client_token }}">
</script>

<script>
paypal.Buttons({
  createOrder: function(data, actions) {
    return actions.order.create({
      purchase_units: [{
        amount: {
          value: $('#order_total').val()
        }
      }]
    });
  },

  onApprove: function(data, actions) {
    // This function captures the funds from the transaction.
    return actions.order.capture().then(function(details) {

      axios.post('/order/create', {
        id: details.id,
        amount: $('#order_total').val()
      })
      .then(function (response) {
          window.location.href = "/checkout/success/" + details.id;
      })
      .catch(function (error) {
          console.log(response);
      });

    });
  }
}).render("#paypal-container").catch((error) => {
  console.error("failed to render the PayPal Buttons", error);
});


if (paypal.HostedFields.isEligible()) {
  let orderId;

  // Renders card fields
  paypal.HostedFields.render({
    // Call your server to set up the transaction
    createOrder: () => {
      return fetch("/api/orders", {
        method: 'post'
        // use the "body" param to optionally pass additional order information like
        // product ids or amount.
      })
      .then((res) => res.json())
      .then((orderData) => {
        orderId = orderData.id; // needed later to complete capture
        return orderData.id
      })
    },
    styles: {
      '.valid': {
        color: 'green'
      },
      '.invalid': {
        color: 'red'
      }
    },
    fields: {
      number: {
        selector: "#card-number",
        placeholder: "4111 1111 1111 1111"
      },
      cvv: {
        selector: "#cvv",
        placeholder: "123"
      },
      expirationDate: {
        selector: "#expiration-date",
        placeholder: "MM/YY"
      }
    }
  }).then((cardFields) => {
   document.querySelector("#card-form").addEventListener("submit", (event) => {
      event.preventDefault();
      cardFields.submit({
          // Cardholder's first and last name
          cardholderName: document.getElementById("card-holder-name").value,
          // Billing Address
          billingAddress: {
            // Street address, line 1
            streetAddress: document.getElementById(
              "card-billing-address-street"
            ).value,
            // Street address, line 2 (Ex: Unit, Apartment, etc.)
            extendedAddress: document.getElementById(
              "card-billing-address-unit"
            ).value,
            // State
            region: document.getElementById("card-billing-address-state").value,
            // City
            locality: document.getElementById("card-billing-address-city")
              .value,
            // Postal Code
            postalCode: document.getElementById("card-billing-address-zip")
              .value,
            // Country Code
            countryCodeAlpha2: document.getElementById(
              "card-billing-address-country"
            ).value,
          },
        })
        .then(() => {
          fetch(`/api/orders/${orderId}/capture`, {
            method: "post",
          })
            .then((res) => res.json())
            .then((orderData) => {
              // Three cases to handle:
              //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
              //   (2) Other non-recoverable errors -> Show a failure message
              //   (3) Successful transaction -> Show confirmation or thank you
              // This example reads a v2/checkout/orders capture response, propagated from the server
              // You could use a different API or structure for your 'orderData'
              var errorDetail =
                Array.isArray(orderData.details) && orderData.details[0];
              if (errorDetail && errorDetail.issue === "INSTRUMENT_DECLINED") {
                return actions.restart(); // Recoverable state, per:
                // https://developer.paypal.com/docs/checkout/integration-features/funding-failure/
              }
              if (errorDetail) {
                var msg = "Sorry, your transaction could not be processed.";
                if (errorDetail.description)
                  msg += "\n\n" + errorDetail.description;
                if (orderData.debug_id) msg += " (" + orderData.debug_id + ")";
                return alert(msg); // Show a failure message
              }
              // Show a success message or redirect
              alert("Transaction completed!");
            });
        })
        .catch((err) => {
          alert("Payment could not be captured! " + JSON.stringify(err));
        });
    });
  });
} else {
  // Hides card fields if the merchant isn't eligible
  document.querySelector("#card-form").style = 'display: none';
}

</script>

@endif

</html>
