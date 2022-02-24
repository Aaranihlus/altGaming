@extends('layouts.main')

@section('content')

  <div class="container">
    <div class="row">
      <input type="hidden" id="order_total" value="{{ $cart_total }}">
      <div class="col" id="paypal-container"></div>
    </div>
  </div>

@endsection
