@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-11">
        <form method="POST" action="/admin/item/store" style="width: 60%;" enctype="multipart/form-data">
          @csrf
        <h1>Create New Shop Item</h1>

        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name">
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <textarea type="text" class="form-control" id="description" name="description"></textarea>
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

        <div class="mb-3">
          <label class="form-label">Create Option Groups</label>
          <div class="form-row row mb-3">
            <div class="form-group col-2">
              <label for="new_group_name">Group Name</label>
              <input type="text" class="form-control my-2" id="new_group_name">
            </div>
            <div class="form-group col-2">
              <button type="button" id="create-option-group-button" class="btn btn-warning">Create Group</button>
            </div>
          </div>
        </div>


        <div class="mb-3">
          <label class="form-label">Colour Options</label>
          <input type="hidden" name="group[0]" value="Colour">

          <div>
            <label class="form-label">Option Name</label>
            <input type="text" class="form-control my-2" name="option_name[0][0]">
            <label class="form-label">Option Price</label>
            <input type="text" class="form-control my-2" name="option_price[0][0]">
          </div>

          <div>
            <label class="form-label">Option Name</label>
            <input type="text" class="form-control my-2" name="option_name[0][1]">
            <label class="form-label">Option Price</label>
            <input type="text" class="form-control my-2" name="option_price[0][1]">
          </div>

          <button type="button" id="add-another-option-button" class="btn btn-warning">Add Option</button>
        </div>

        <button type="submit" class="btn btn-warning">Create</button>
      </div>

    </div>


  </div>

@endsection
