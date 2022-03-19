@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-11">
        <form method="POST" action="/admin/badge/store" style="width: 75%;" enctype="multipart/form-data">
          @csrf
        <h1>Create New Badge</h1>

        <div class="mb-3">
          <label for="badge" class="form-label">Badge</label>
          <input type="file" class="form-control" id="badge" name="badge">
        </div>

        <button type="submit" class="btn btn-warning">Create</button>
      </div>

    </div>


  </div>

@endsection
