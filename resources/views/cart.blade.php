@extends('layouts.main')

@section('content')

  <div class="container">

    <div class="row">

      <div class="col-lg-8 col-xl-8 col-sm-12 col-md-12 col-xs-12">

        @if ( !empty($cart) )
          <h1>Your cart</h1>
        @foreach( $cart as $k => $c )
          <div class="bg-alt-yellow p-2 extra-rounded my-2" style="width: 100%;display: flex;align-content: center;align-items: center;justify-content: space-between;">
            <div style="display: flex; align-items: center;">
              <img class="img-fluid rounded" style="width: 7vw;" src="{{ asset("storage/" . $c->images[0]->path) }}">
              <h5 class="mx-3">{{ $c->name }}</h5>
            </div>
            <div style="display: flex; align-items: center;">
              <input style="width: 50px" type="number" value="{{ $c->quantity }}" class="form-control item-quantity mx-2 rounded"/>
              <i class="fas fa-trash delete-cart-item mx-4" data-id={{ $c->id }} data-index="{{ $k }}"></i>
              <h5 class="mx-4 my-0">£ {{ $c->price }}</h5>
            </div>
          </div>
        @endforeach
      @else
        <div class="flex-y" style="align-items: center;">
          <h1>Your cart is empty!</h1>
          <button type="button" class="btn btn-warning my-4"><a class="link-dark" href="/shop/all">Go To Shop</a></button>
        </div>
      @endif

      </div>

      @if ( !empty($cart) )
      <div class="col-lg-4 col-xl-4 col-sm-12 col-md-12 col-xs-12 bg-alt-yellow extra-rounded p-3" style="display: flex; flex-direction: column; flex-wrap: nowrap; align-content: center; justify-content: space-around; align-items: stretch; text-align: center;">
        <h1>Ready to checkout?</h1>
        <input type="hidden" id="order_total" value="{{ $cart_total }}">
        <h3>Order Total: £<span id="cart-total">{{ number_format($cart_total, 2) }}</span></h3>
        <div id="paypal-container"></div>
        <!--<button type="button" class="btn btn-warning go-to-checkout-button"><a class="link-dark" href="/checkout">Go To Checkout</a></button>-->
      </div>
      @endif

    </div>

  </div>

@endsection
