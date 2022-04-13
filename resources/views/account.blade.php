@extends('layouts.main')

@section('content')

<div class="container">

  <x-ajax-request-status></x-ajax-request-status>

  <div class="row">

    <div class="col-lg-5 col-xl-5 col-sm-12 col-xs-12 col-md-12">

      <div class="bg-alt-yellow p-3 extra-rounded">

      <h1>Account Info</h1>

        <div class="mb-3">
          <label for="email" class="form-label">Email</label>
          <p>{{ $user->email }}</p>
        </div>

      <hr>

      <h3>Delivery Address</h3>

      <form method="POST" action="/account/update" enctype="multipart/form-data">
        @csrf
      <div class="flex-x row">
        <div class="mb-3 col-6">
          <label for="first_name" class="form-label">First Name</label>
          <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}">
        </div>
        <div class="mb-3 col-6">
          <label for="surname" class="form-label">Surname</label>
          <input type="text" class="form-control" id="surname" name="surname" value="{{ $user->surname }}">
        </div>
      </div>

      <div class="mb-3">
        <label for="address_line1" class="form-label">Address Line 1</label>
        <input type="text" class="form-control" id="address_line_1" name="address_line_1" value="{{ $user->address_line_1 }}">
      </div>

      <div class="mb-3">
        <label for="address_line2" class="form-label">Address Line 2</label>
        <input type="text" class="form-control" id="address_line_2" name="address_line_2" value="{{ $user->address_line_2 }}">
      </div>

      <div class="flex-x">
        <div class="mb-3">
          <label for="county" class="form-label">County</label>
          <input type="text" class="form-control" id="county" name="county" value="{{ $user->county }}">
        </div>

        <div class="mb-3 mx-3">
          <label for="county" class="form-label">Town</label>
          <input type="text" class="form-control" id="town" name="town" value="{{ $user->town }}">
        </div>

        <div class="mb-3 ml-1">
          <label for="postcode" class="form-label">Postcode</label>
          <input type="text" class="form-control" id="postcode" name="postcode" value="{{ $user->postcode }}">
        </div>
      </div>

      <hr>

      <button type="submit" class="btn btn-warning mx-1">Update Account</button>

    </div>

    </div>

    <div class="col-lg-7 col-xl-7 col-sm-12 col-xs-12 col-md-12">

      <div class="bg-alt-yellow p-3 extra-rounded">
      <h1>Order History</h1>
      @if(count($user->orders) > 0)
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Number</th>
            <th>Date</th>
            <th>Total</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          @foreach($user->orders as $order)
            <tr>
            <td><span>{{ $order->paypal_id }}</span></td>
            <td><span>{{ $order->created_at }}</span></td>
            <td><span>{{ $order->total }}</span></td>
            <td>
              <button class="btn btn-warning mx-1"><a href="/account/order/{{ $order->paypal_id }}">View</a></button>
              <button class="btn btn-warning mx-1"><a target="_blank" href="/account/order/invoice/{{ $order->paypal_id }}">Invoice</a></button>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
        <h4>There's nothing here yet</h4>
      @endif
    </div>

  </div>

  </div>

</div>
@endsection
