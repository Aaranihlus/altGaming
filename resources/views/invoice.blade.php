<div class="container">

    <div class="row">

      <div class="col-lg-8">
        <h1>Order #{{ $order->paypal_id }}</h1>

        @foreach( $order->items as $k => $v )
          <div class="bg-alt-yellow p-2 extra-rounded my-2" style="width: 100%; display: flex; align-content: center; align-items: center; justify-content: space-between;">
            <div style="display: flex; align-items: center;">
              <img class="img-fluid rounded" style="width: 7vw;" src="{{ asset("storage/" . $v->item->images[0]->path) }}">
              <h5 class="mx-3">{{ $v->item->name }}</h5>
            </div>
            <div style="display: flex; align-items: center;">
              <h5 class="mx-4 my-0">Quantity: {{ $v->quantity }}</h5>
              <h5 class="mx-4 my-0">£ {{ $v->item->price }}</h5>
            </div>
          </div>
        @endforeach

        <h1>Total: £{{ $order->amount }}</h1>

      </div>

    </div>

  </div>
