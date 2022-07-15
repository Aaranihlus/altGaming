@extends('layouts.main')

@section('content')

  <div class="container">

    <div class="row">

      <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 col-xl-12">
        <h3>Order #{{ $order->id }}</h3>
        <h4>Status: {{ $order->status }}</h4>
        <p>Paypal Transaction ID: {{ $order->paypal_id}}</p>
        <p>Order Date: {{ $order->created_at }}</p>

        @foreach( $order->items as $k => $v )
          <div class="bg-alt-yellow p-2 extra-rounded my-2 flex-x center-x" style="width: 100%; display: flex; align-content: center; justify-content: space-between;">
            <div class="flex-x center-x">
              <img class="img-fluid rounded" style="width: 7vw;" src="{{ asset("storage/" . $v->item->images[0]->path) }}">
              <h5 class="mx-3">{{ $v->item->name }}</h5>
            </div>
            @if($v->options)
            <div>
              @foreach($v->options as $opt)
                <span>{{ $opt->option->group->name }}: {{ $opt->option->name }}</span><br>
              @endforeach
            </div>
            @endif
            <div class="flex-x center-x">
              <h5 class="mx-4 my-0">Quantity: {{ $v->quantity }}</h5>
              <h5 class="mx-4 my-0">£ {{ $v->unit_price }}</h5>
            </div>
          </div>
        @endforeach

        <h3>Order Total: £{{ $order->total }}</h3>

      </div>

    </div>

  </div>

@endsection
