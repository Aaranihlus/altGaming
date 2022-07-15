@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-11">
        <h1>Manage Orders</h1>

        <table class="table table-hover bg-alt-yellow rounded my-3">
          <thead>
            <tr>
              <th scope="col">Order #</th>
              <th>Total</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($orders as $order)
            <tr>
                <td><span>{{ $order->id }}</span></td>
                <td><span>£{{ $order->total }}</span></td>
                <td><span>{{ $order->created_at }}</span></td>
                <td>
                  <button type="button" class="btn btn-warning"><a class="link-dark" href="/admin/order/view/{{ $order->id }}">View</a></button>
                  <button type="button" class="btn btn-warning"><a class="link-dark" target="_blank" href="/admin/order/invoice/{{ $order->id }}">Invoice</a></button>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>

    </div>


  </div>

@endsection
