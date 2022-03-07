@extends('layouts.main')

@section('content')

  <div class="container bg-alt-yellow extra-rounded p-4" style="display: flex; flex-direction: row; align-items: center; justify-content: center; width: 100%;">
    <input type="hidden" id="order_total" value="{{ $cart_total }}">
    <div id="paypal-container"></div>
  </div>

@endsection
