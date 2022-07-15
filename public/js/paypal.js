var orderID;

paypal.Buttons({

  createOrder: function(data, actions) {

    axios.post('/order/create', {
      total: $('#order_total').text()
    })
    .then(function (response) {
      orderID = response.data.order_id;
    });

    return actions.order.create({
      purchase_units: [{
        amount: {
          value: $('#order_total').text()
        }
      }]
    });
  },

  onApprove: function(data, actions) {
    // This function captures the funds from the transaction.
    return actions.order.capture().then(function(details) {
      axios.post('/order/approve', {
        paypal_id: details.id,
        order_id: orderID
      })
      .then(function (response) {
        window.location.href = "/checkout/success/" + response.data.id;
      });
    });
  }
}).render("#paypal-container").catch((error) => {
  console.error("failed to render the PayPal Buttons", error);
});



if (paypal.HostedFields.isEligible()) {

  document.querySelector("#paypal-card-container").style = 'display: block';

  // Renders card fields
  paypal.HostedFields.render({

    createOrder: function(data, actions) {

      axios.post('/order/create', {
        total: $('#order_total').text()
      })
      .then(function (response) {
        orderID = response.data.order_id;
      });

      return actions.order.create({
        purchase_units: [{
          amount: {
            value: $('#order_total').text()
          }
        }]
      });
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
          cardholderName: document.getElementById("card-holder-name").value,
          billingAddress: {
            streetAddress: document.getElementById("card-billing-address-street").value,
            extendedAddress: document.getElementById("card-billing-address-unit").value,
            region: document.getElementById("card-billing-address-state").value,
            locality: document.getElementById("card-billing-address-city").value,
            postalCode: document.getElementById("card-billing-address-zip").value,
            countryCodeAlpha2: document.getElementById("card-billing-address-country").value,
          },
        })
        .then(() => {

          fetch(`/api/orders/${orderID}/capture`, {
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
              var errorDetail = Array.isArray(orderData.details) && orderData.details[0];

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
  console.log("Hosted fields go bye bye");
  document.querySelector("#paypal-card-container").style = 'display: none';
}
