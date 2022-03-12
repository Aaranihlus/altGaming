@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-11">

        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="/admin/event/store" style="width: 75%;" enctype="multipart/form-data">
          @csrf
        <h1>Create New Event</h1>

        <div class="mb-3">
          <label class="form-label">Event Type</label>

          <div class="form-check">
            <input class="form-check-input event_type_radio" type="radio" name="type" id="alt_lan" value="altlan">
            <label class="form-check-label" for="alt_lan">
              altLAN
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input event_type_radio" type="radio" name="type" id="other" value="other">
            <label class="form-check-label" for="other">
              Other
            </label>
          </div>
        </div>

        <hr>

        <div class="mb-3 other_only">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" name="title">
        </div>

        <div class="mb-3 lan_only">
          <label for="location" class="form-label">Location</label>
          <input type="text" class="form-control" id="location" name="location">
        </div>

        <!--<div class="mb-3 lan_only">
          <label for="google_maps_pin" class="form-label">Google Maps Pin</label>
          <input type="text" class="form-control" id="google_maps_pin" name="google_maps_pin">
        </div>-->

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
          <label for="thumbnail" class="form-label">Thumbnail</label>
          <input type="file" class="form-control" id="thumbnail" name="thumbnail">
        </div>

        <button type="submit" class="btn btn-warning">Create</button>
      </div>

    </div>


  </div>

@endsection
