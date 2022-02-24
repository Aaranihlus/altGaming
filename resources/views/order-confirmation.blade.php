@extends('layouts.main')

@section('content')
  <div class="container">
    <div class="flex-y" style="text-align: center;">
      <h1>Thank you!</h1>
      <h3>We have your order</h3>
      <h3>Your Order ID: {{ $order->paypal_id }}</h3>
      <h3>Total Paid: £{{ $order->amount }}</h3>
    </div>
  </div>
@endsection
