@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-11">
        <form method="POST" action="/admin/item/update/{{ $item->id }}" style="width: 75%;" enctype="multipart/form-data">
          @csrf
        <h1>Edit Shop Item</h1>

        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name" value="{{ $item->name }}">
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <input type="text" class="form-control" id="description" name="description" value="{{ $item->description }}">
        </div>

        <div class="mb-3">
          <label for="price" class="form-label">Price</label>
          <input type="text" class="form-control" id="price" name="price" value="{{ $item->price }}">
        </div>

        <div class="mb-3">
          <label for="image_input" class="form-label">Item Images</label>
          <br>
          <div class="container-fluid g-0">
            <div class="row">
              @foreach( $item->images as $i )
                <div class="col-3">
                  <img class="rounded img-fluid my-2" style="width: 100%;" src='{{asset("storage/$i->path")}}'>
                  <button type="button" class="btn btn-warning delete-image-button" data-id="{{ $i->id }}"><i class="fas fa-trash"></i> Delete</button>
                </div>
              @endforeach
            </div>
          </div>

          <hr>

          <button type="button" id="add-another-image-button" class="btn btn-warning">Add Another</button>
        </div>

        <button type="submit" class="btn btn-warning">Update</button>
      </div>

    </div>


  </div>

@endsection
