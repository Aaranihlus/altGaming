@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-11">
        <form method="POST" action="/admin/achievement/store" style="width: 75%;" enctype="multipart/form-data">
          @csrf
        <h1>Manage Hero Banner</h1>

        <p>Hero Banner Active?</p>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="hero_enabled" id="enabled_option">
          <label class="form-check-label" for="enabled_option">
            Enabled
          </label>
        </div>
        <div class="form-check">
          <input class="form-check-input" type="radio" name="hero_enabled" id="disabled_option" checked>
          <label class="form-check-label" for="disabled_option">
            Disabled
          </label>
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
