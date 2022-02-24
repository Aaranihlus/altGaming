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
            <input class="form-check-input event_type_radio" type="radio" name="type" id="alt_lan" value="alt lan">
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

        <div class="mb-3 other_only" style="display: none;">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" name="title">
        </div>

        <div class="mb-3 lan_only" style="display: none;">
          <label for="location" class="form-label">Location</label>
          <input type="text" class="form-control" id="location" name="location">
        </div>


        <div class="mb-3">
          <label for="start_date" class="form-label">Start Date</label>
          <input type="date" class="form-control" id="start_date" name="start_date">
        </div>



        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <input type="text" class="form-control" id="description" name="description">
        </div>

        <button type="submit" class="btn btn-warning">Create</button>
      </div>

    </div>


  </div>

@endsection
