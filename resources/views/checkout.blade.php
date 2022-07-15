@extends('layouts.main')

@section('content')

  <div class="container">

    <div class="row">

      @if ( !empty($cart) )
        <div class="col-lg-6 col-xl-6 col-sm-12 col-md-12 col-xs-12 bg-alt-yellow extra-rounded p-3" style="display: flex; flex-direction: column; flex-wrap: nowrap; align-content: center; justify-content: center; align-items: center; text-align: center;">
          <input type="hidden" id="order_total" value="{{ $cart_total }}">
          <!--<button type="button" class="btn btn-warning my-2" style="height: 30%;" id="show-checkout">Checkout Now</button>
          <i style="display: none;" id="loading-spinner" class="fa-2x fas fa-spinner fa-spin"></i>-->

          <div id="paypal-container" style="width: 100%; border-radius: 6px;"></div>

          <div id="paypal-card-container" class="card_container" style="display: none;">
            <br>
            <p style="text-align: center;">OR</p>
            <form id="card-form">
              <label for="card-number">Card Number</label><div id="card-number" class="card_field form-control"></div>
              <div>
                <label for="expiration-date">Expiration Date</label>
                <div id="expiration-date" class="card_field form-control"></div>
              </div>
              <div>
                <label for="cvv">CVV</label><div id="cvv" class="card_field form-control"></div>
              </div>
              <label for="card-holder-name">Name on Card</label>
              <input type="text" id="card-holder-name" name="card-holder-name" autocomplete="off" placeholder="card holder name" class="form-control"/>
              <div class="mb-3">
                <label for="card-billing-address-street">Billing Address</label>
                <input type="text" id="card-billing-address-street" name="card-billing-address-street" autocomplete="off" placeholder="street address" class="form-control"/>
              </div>
              <div class="mb-3">
                <label for="card-billing-address-unit">&nbsp;</label>
                <input type="text" id="card-billing-address-unit" name="card-billing-address-unit" autocomplete="off" placeholder="unit" class="form-control"/>
              </div>
              <div class="mb-3">
                <input type="text" id="card-billing-address-city" name="card-billing-address-city" autocomplete="off" placeholder="city" class="form-control"/>
              </div>
              <div class="mb-3">
                <input type="text" id="card-billing-address-state" name="card-billing-address-state" autocomplete="off" placeholder="state" class="form-control"/>
              </div>
              <div class="mb-3">
                <input type="text" id="card-billing-address-zip" name="card-billing-address-zip" autocomplete="off" placeholder="zip / postal code" class="form-control"/>
              </div>
              <div class="mb-3">
                <input type="text" id="card-billing-address-country" name="card-billing-address-country" autocomplete="off" placeholder="country code" class="form-control"/>
              </div>
              <br/>
              <button type="submit" class="btn btn-warning my-2" id="submit" style="width: 75%;">Pay</button>
            </form>
          </div>
        </div>

        <div class="col-lg-6 col-xl-6 col-sm-12 col-md-12 col-xs-12">
          @foreach( $cart as $k => $c )
            <div class="bg-alt-yellow p-2 extra-rounded" style="width: 100%; display: flex; align-content: center; align-items: center; justify-content: space-between; margin-bottom: 8px;">
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
          <h3>Order Total: £<span id="cart-total">{{ number_format($cart_total, 2) }}</span></h3>
        </div>
      @else
        <div class="flex-y" style="align-items: center;">
          <h1>Your cart is empty!</h1>
          <button type="button" class="btn btn-warning my-4"><a class="link-dark" href="/shop/all">Go To Shop</a></button>
        </div>
      @endif

    </div>

  </div>

@endsection
