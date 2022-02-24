@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-11">
        <form method="POST" action="/admin/item/store" style="width: 75%;" enctype="multipart/form-data">
          @csrf
        <h1>Create New Shop Item</h1>

        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name">
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <input type="text" class="form-control" id="description" name="description">
        </div>

        <div class="mb-3">
          <label for="price" class="form-label">Price</label>
          <input type="text" class="form-control" id="price" name="price">
        </div>

        <div class="mb-3">
          <label for="image_input" class="form-label">Item Images</label>
          <input type="file" class="form-control image-input my-2" name="image[0]">
          <button type="button" id="add-another-image-button" class="btn btn-warning">Add Another</button>
        </div>

        <button type="submit" class="btn btn-warning">Create</button>
      </div>

    </div>


  </div>

@endsection
