@extends('layouts.main')

@section('content')
  <div class="container-fluid">
    <div class="row">
      @include('admin/menu')
      <div class="col-11">
        <h1>altAdmin Home</h1>
        <p>Probably gunne have some metrics or something here</p>
        <div class="container-fluid g-0">
          <div class="row">
            <div class="col-3">New Users</div>
            <div class="col-3">New Orders</div>
            <div class="col-3"></div>
            <div class="col-3"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
