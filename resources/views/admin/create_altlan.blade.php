@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-11">
        <form method="POST" action="/admin/altlan/store" style="width: 75%;" enctype="multipart/form-data">
          @csrf
        <h1>Create New altLAN</h1>

        <div class="mb-3">
          <label for="number" class="form-label">Number</label>
          <input type="text" class="form-control" id="number" name="number">
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <input type="text" class="form-control" id="description" name="description">
        </div>

        <div class="mb-3">
          <label for="date" class="form-label">Date</label>
          <input type="text" class="form-control" id="date" name="date">
        </div>

        <div class="mb-3">
          <label for="location" class="form-label">Location</label>
          <input type="text" class="form-control" id="location" name="location">
        </div>

        <div class="mb-3">
          <label for="ticket_price" class="form-label">Ticket Price</label>
          <input type="text" class="form-control" id="ticket_price" name="ticket_price">
        </div>

        <button type="submit" class="btn btn-warning">Create</button>
      </div>

    </div>


  </div>

@endsection
