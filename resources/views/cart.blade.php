@extends('layouts.main')

@section('content')

  <div class="container">

    <div class="row">

        @if ( !empty($cart) )
          <div class="col-lg-8 col-xl-8 col-sm-12 col-md-12 col-xs-12">
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
        </div>
      @else
        <div class="flex-y" style="align-items: center;">
          <h1>Your cart is empty!</h1>
          <button type="button" class="btn btn-warning my-4"><a class="link-dark" href="/shop/all">Go To Shop</a></button>
        </div>
      @endif

      @if ( !empty($cart) )
      <div class="col-lg-4 col-xl-4 col-sm-12 col-md-12 col-xs-12 bg-alt-yellow extra-rounded p-3" style="display: flex; flex-direction: column; flex-wrap: nowrap; align-content: center; justify-content: space-around; align-items: stretch; text-align: center;">

        <input type="hidden" id="order_total" value="{{ $cart_total }}">
        <input type="hidden" id="access_token" value="{{ $access_token }}">
        <input type="hidden" id="client_id" value="{{ $client_id }}">

        <h3>Order Total: £<span id="cart-total">{{ number_format($cart_total, 2) }}</span></h3>
        <!--<button type="button" class="btn btn-warning my-2" style="height: 30%;" id="show-checkout">Checkout Now</button>
        <i style="display: none;" id="loading-spinner" class="fa-2x fas fa-spinner fa-spin"></i>-->

        <div id="paypal-container"></div>
        <p style="text-align: center;">OR</p>
        <div class="card_container">
          <form id="card-form">

            <label for="card-number">Card Number</label>
            <div id="card-number" class="card_field"></div>

            <div>
              <label for="expiration-date">Expiration Date</label>
              <div id="expiration-date" class="card_field"></div>
            </div>

            <div>
              <label for="cvv">CVV</label>
              <div id="cvv" class="card_field"></div>
            </div>

            <label for="card-holder-name">Name on Card</label>
            <input type="text" id="card-holder-name" name="card-holder-name" autocomplete="off" placeholder="card holder name"/>

            <div>
              <label for="card-billing-address-street">Billing Address</label>
              <input type="text" id="card-billing-address-street" name="card-billing-address-street" autocomplete="off" placeholder="street address"/>
            </div>

            <div>
              <label for="card-billing-address-unit">&nbsp;</label>
              <input type="text" id="card-billing-address-unit" name="card-billing-address-unit" autocomplete="off" placeholder="unit"/>
            </div>

            <div>
              <input type="text" id="card-billing-address-city" name="card-billing-address-city" autocomplete="off" placeholder="city"/>
            </div>

            <div>
              <input type="text" id="card-billing-address-state" name="card-billing-address-state" autocomplete="off" placeholder="state"/>
            </div>

            <div>
              <input type="text" id="card-billing-address-zip" name="card-billing-address-zip" autocomplete="off" placeholder="zip / postal code"/>
            </div>

            <div>
              <input type="text" id="card-billing-address-country" name="card-billing-address-country" autocomplete="off" placeholder="country code" />
            </div>

            <br/>

            <button value="submit" id="submit" class="btn">Pay</button>
          </form>
        </div>

        </div>
      </div>
      @endif

    </div>

  </div>

@endsection
