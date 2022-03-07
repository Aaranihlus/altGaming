@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-11">
        <form method="POST" action="/admin/role/store" style="width: 75%;" enctype="multipart/form-data">
          @csrf
        <h1>Create New Role</h1>

        <div class="mb-3">
          <label for="title" class="form-label">Role Name</label>
          <input type="text" class="form-control" id="name" name="name">
        </div>

        <button type="submit" class="btn btn-warning">Create</button>
      </div>

    </div>


  </div>

@endsection
