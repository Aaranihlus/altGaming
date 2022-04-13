@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-10">
        <h1>Manage Hero Banner</h1>

        @if($heroEnabled)
          <p style="margin-bottom: 0px;">Hero Banner Status:
            <span style="color: green; font-weight: bold;" id="hero-banner-status">
              Enabled
            </span>
          </p>
          <button type="button" class="btn btn-warning enable-hero-button" style="display: none;">Enable</button>
          <button type="button" class="btn btn-warning disable-hero-button">Disable</button>
        @else
          <p style="margin-bottom: 0px;">Hero Banner Status:
            <span style="color: red; font-weight: bold;" id="hero-banner-status">
              Disabled
            </span>
          </p>
          <button type="button" class="btn btn-warning enable-hero-button">Enable</button>
          <button type="button" class="btn btn-warning disable-hero-button" style="display: none;">Disable</button>
        @endif

        <hr>

        <div class="container g-0 m-0">
          <div class="row">
            <div class="col-4">
              <p>Add New Items To Hero Banner</p>
              <form method="POST" action="/admin/hero/store" style="width: 75%;" enctype="multipart/form-data">
                @csrf

              <p>Type</p>
              <div class="mb-4">

                <select class="form-select hero-type-select mb-4" name="item_type">
                  <option></option>
                  <option value="event">Event</option>
                  <option value="altlan">altLAN</option>
                  <option value="item">Item</option>
                  <option value="blog">Blog</option>
                  <option value="podcast">Podcast</option>
                </select>

                <p>Item</p>
                <select class="form-select hero-item-select" name="item_id"></select>
              </div>

              <p>Custom Text</p>
              <textarea class="form-control custom-text-input" name="custom_text" style="height: 100px;"></textarea>

              <br>

              <p>Custom Image</p>
              <input class="form-control custom-image-input" type="file" name="custom_image"></input>

              <br>

              <button type="submit" class="btn btn-warning">Add To Hero Banner</button>
              </form>
            </div>

            <div class="col-8">
              <p>Current Items</p>
              <div class="hero-items-container">
                <form method="POST" action="/admin/hero/update_order" style="width: 75%;" enctype="multipart/form-data">
                  @csrf
                @foreach($heroItems as $k => $item)
                  <div class="bg-alt-yellow flex-x extra-rounded p-3 mb-4 hero-item" style="align-items: center; justify-content: space-between">
                    <p class="m-0">{{ $item->order }} - {{ $item->title ?? $item->name }} - {{ $item->custom_text }}</p>
                    <button type="button" class="btn btn-warning mx-2 delete-hero-button" data-id="{{ $item->hero_id }}">Delete</button>
                  </div>
                @endforeach
              </div>
              <button type="submit" class="btn btn-warning">Save Hero Banner Order</button>
            </form>
            </div>
          </div>
        </div>

      </div>

    </div>


  </div>

@endsection
