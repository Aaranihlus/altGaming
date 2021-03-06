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
          <textarea type="text" class="form-control" id="description" name="description" style="height: 15vh;"></textarea>
        </div>

        <div class="mb-3">
          <label for="price" class="form-label">Base Price</label>
          <input type="text" class="form-control" id="price" name="price">
        </div>

        <hr>

        <div class="mb-3">
          <label for="image_input" class="form-label">Item Images</label>
          <input type="file" class="form-control image-input my-2" name="image[0]">

          <br>
          <button type="button" id="add-another-image-button" class="btn btn-warning">Add Another</button>
        </div>

        <hr>

        <div class="mb-3">
          <label class="form-label">Create Option Groups</label>
          <div class="form-row row mb-3">
            <div class="form-group col-4">
              <input type="text" class="form-control" id="new_group_name" placeholder="New Group Name">
            </div>
            <div class="form-group col-4">
              <button type="button" id="create-option-group-button" class="btn btn-warning">Create Group</button>
            </div>
          </div>
        </div>


        <div class="mb-3" id="option-groups-container">
        </div>

        <button type="submit" class="btn btn-warning">Create</button>
      </div>

    </div>


  </div>

@endsection
