@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-11">
        <form method="POST" action="/admin/achievement/store" style="width: 75%;" enctype="multipart/form-data">
          @csrf
        <h1>Create New Achievement</h1>

        <div class="mb-3">
          <label for="name" class="form-label">Name</label>
          <input type="text" class="form-control" id="name" name="name">
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <input type="text" class="form-control" id="description" name="description">
        </div>

        <div class="form-check mb-3">
          <input class="form-check-input" type="checkbox" name="unlock_item" id="unlock_item">
          <label class="form-check-label" for="unlock_item">Does this achievement unlock a shop item?</label>
        </div>

        <div class="mb-3" id="item-select-container" style="display: none;">
          <select class="form-select" name="item_id">
            <option></option>
            @foreach ( $items as $item )
              <option value="{{ $item->id }}">{{ $item->name }}</option>
            @endforeach
          </select>
        </div>

        <button type="submit" class="btn btn-warning">Create</button>
      </div>

    </div>


  </div>

@endsection
