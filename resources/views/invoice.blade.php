<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

<div class="container">

  <div class="row">

    <div class="col-lg-8">
      <h1>Order #{{ $paypal_id }}</h1>

      @foreach( $order_items as $item )
        <div class="bg-alt-yellow p-2 extra-rounded my-2" style="width: 100%; display: flex; align-content: center; align-items: center; justify-content: space-between;">
          <div style="display: flex; align-items: center;">
            <h5 class="mx-3">{{ $item['name'] }}</h5>
          </div>
          <div style="display: flex; align-items: center;">
            <h5 class="mx-4 my-0">Quantity: {{ $item['quantity'] }}</h5>
            <h5 class="mx-4 my-0">£ {{ $item['price'] }}</h5>
          </div>
        </div>
      @endforeach

      <h1>Total: £{{ $order_total }}</h1>

    </div>

  </div>

</div>
