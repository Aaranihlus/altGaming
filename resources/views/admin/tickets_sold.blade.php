@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-11">
        <h1>Tickets Sold For {{ $event->title }}</h1>

        <table class="table table-hover bg-alt-yellow rounded my-3">
          <thead>
            <tr>
              <th scope="col">User</th>
              <th>Date of Purchase</th>
              <th>Quantity Purchased</th>
              <th>Ticket Type</th>
              <th>Order ID</th>
            </tr>
          </thead>
          <tbody>
            @foreach($event->orders as $order)
              <tr>
                <td><span>{{ $order->order->user->username }}</span></td>
                <td><span>{{ $order->created_at }}</span></td>
                <td><span>{{ $order->quantity }}</span></td>
                <td><span>{{ $order->item->name }}</span></td>
                <td><a style="text-decoration: underline;" href="/admin/order/view/{{ $order->order->paypal_id }}">{{ $order->order->paypal_id }}</a></td>
              </tr>
            @endforeach
          </tbody>
        </table>

      </div>

    </div>


  </div>

@endsection
