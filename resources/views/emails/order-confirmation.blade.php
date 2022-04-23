@extends('layouts.main')

@section('content')

  <div class="container">

    <div class="row">

      @if(!empty($cart_items))
        <div class="col-lg-8 col-xl-8 col-sm-12 col-md-12 col-xs-12">
          <h1>Your cart</h1>
          @foreach( $cart_items as $k => $v )
            <div class="bg-alt-yellow p-2 extra-rounded my-1 flex-x center-x" style="align-content: center; justify-content: space-between;">
              <div style="display: flex; align-items: center;">
                <img class="img-fluid rounded" style="width: 7vw;" src="{{ asset("storage/" . $v->images[0]->path) }}">
                <h5 class="mx-3">{{ $v['name'] }}</h5>
                @if($v->options)
                <div class="flex-y">
                  @foreach($v->options as $option)
                    <span>{{ $option->group->name }}: {{ $option->name }}</span>
                  @endforeach
                </div>
                @endif
              </div>
              <div class="flex-x center-x">
                <input style="width: 50px" type="number" value="{{ $v['quantity'] }}" class="form-control item-quantity mx-2 rounded"/>
                <i class="fas fa-trash delete-cart-item mx-4" data-id={{ $v['id'] }} data-index="{{ $k }}"></i>
                <h5 class="mx-4 my-0">£ {{ $v['unit_price'] }}</h5>
              </div>
            </div>
          @endforeach
          <button type="button" class="btn btn-warning my-4"><a class="link-dark" href="/cart/clear">Clear Cart</a></button>
        </div>

        <div class="col-lg-4 col-xl-4 col-sm-12 col-md-12 col-xs-12">
          <div class="bg-alt-yellow p-2 extra-rounded flex-y center-x center-y">
            <h2>Cart Total: £<span id="cart-total">{{ $cart_total ?? "" }}</span></h2>
            <button type="button" class="btn btn-warning"><a class="link-dark" href="/checkout">Proceed To Checkout</a></button>
          </div>
        </div>

      @else
        <div class="flex-y center-x center-y">
          <h1>Your cart is empty!</h1>
          <button type="button" class="btn btn-warning my-4"><a class="link-dark" href="/shop/all">Go To Shop</a></button>
        </div>
      @endif

    </div>

  </div>

@endsection
