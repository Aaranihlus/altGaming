@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-11">

        <h1>Editing {{ $event->title }}</h1>
        <hr>

        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="/admin/event/update/{{ $event->id }}" style="width: 75%;" enctype="multipart/form-data">

          @csrf

          <div class="mb-3 other_only">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $event->title }}">
          </div>

          <div class="mb-3 lan_only">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" id="location" name="location" value="{{ $event->location }}">
          </div>

          <div class="form-row row mb-3">
            <div class="form-group col-2">
              <label for="start_date">Starting</label>
              <input type="date" class="form-control" id="start_date" name="start_date">
            </div>
            <div class="form-group col-2">
              <label for="end_date">Until</label>
              <input type="date" class="form-control" id="end_date" name="end_date">
            </div>
          </div>


          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description">
          </div>

          <div class="mb-3">
            <label for="new_thumbnail" class="form-label">New Thumbnail</label>
            <input type="file" class="form-control" id="new_thumbnail" name="new_thumbnail">
          </div>

          <button type="submit" class="btn btn-warning">Update</button>

        </form>

      </div>

    </div>

  </div>

@endsection
