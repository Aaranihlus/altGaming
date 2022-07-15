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
          <label for="price" class="form-label">Base Price</label>
          <input type="text" class="form-control" id="price" name="price" value="{{ $item->price }}">
        </div>

        <hr>

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
          @foreach($item->groups as $k => $group)
            <div class="bg-alt-yellow mb-3 extra-rounded p-3 option-group-container">
              <label class="form-label">{{ $group->name }} Options</label>
              <input type="hidden" name="group[{{ $k }}]" value="{{ $group->name }}">
              <div class="options-container">
                @foreach($group->options as $j => $option)
                  <div class="flex-x option-container mb-3" style="align-items: center;">
                    <label class="form-label">Name</label>
                    <input type="text" class="form-control mx-2" style="width: 160px;" name="option_name[{{ $k }}][{{ $j }}]" value="{{ $option->name }}">
                    <label class="form-label mx-2">Price Modifier</label>
                    <input type="number" class="form-control mx-2" style="width: 160px;" name="option_price[{{ $k }}][{{ $j }}]" value="{{ $option->price_modifier }}">
                  </div>
                @endforeach
              </div>
              <button type="button" id="add-another-option-button" data-group="{{ $k }}" class="btn btn-warning">Add Option</button>
            </div>
          @endforeach
        </div>

        <button type="submit" class="btn btn-warning">Update Item</button>
      </div>

    </div>


  </div>

@endsection
