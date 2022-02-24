@extends('layouts.main')

@section('content')

<div class="container">

  <h1>Account Info</h1>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
    </div>

    <div class="mb-3">
      <label for="password" class="form-label">Set New Password</label>
      <input type="password" class="form-control" id="password" name="password">
    </div>

  <hr>

  <h1>Delivery Address (For merch orders)</h1>

  <div class="mb-3">
    <label for="real_name" class="form-label">Name</label>
    <input type="text" class="form-control" id="real_name" name="real_name">
  </div>

  <div class="mb-3">
    <label for="address_line1" class="form-label">Address Line 1</label>
    <input type="text" class="form-control" id="address_line1" name="address_line1">
  </div>

  <div class="mb-3">
    <label for="address_line2" class="form-label">Address Line 2</label>
    <input type="text" class="form-control" id="address_line2" name="address_line2">
  </div>

  <div class="mb-3">
    <label for="address_line3" class="form-label">Address Line 3</label>
    <input type="text" class="form-control" id="address_line3" name="address_line3">
  </div>

  <div class="mb-3">
    <label for="address_line4" class="form-label">Address Line 4</label>
    <input type="text" class="form-control" id="address_line4" name="address_line4">
  </div>

  <div class="mb-3">
    <label for="postcode" class="form-label">Postcode</label>
    <input type="text" class="form-control" id="postcode" name="postcode">
  </div>

  <button type="submit" class="btn btn-warning mx-1">Update Account</button>

  <hr>

  <h1>Order History</h1>
  <table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">Order ID</th>
        <th>Order Date</th>
        <th>Order Items</th>
        <th>Order Total</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($user->orders as $order)
        <td><span>{{ $order->paypal_id }}</span></td>
        <td><span>{{ $order->created_at }}</span></td>
        <td><span>{{ count($order->items) }}</span></td>
        <td><span>{{ $order->amount }}</span></td>
        <td><button type="submit" class="btn btn-warning mx-1"><a href="/account/order/{{ $order->paypal_id }}">View</a></button></td>
      @endforeach
    </tbody>
  </table>

</div>
@endsection
