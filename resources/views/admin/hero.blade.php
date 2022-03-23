@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-11">
        <form method="POST" action="/admin/hero/store" style="width: 75%;" enctype="multipart/form-data">
          @csrf
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

              <p>Type</p>
              <div class="mb-4">
                <select class="form-select hero-type-select mb-4" name="item_type">
                  <option></option>
                  <option value="event">Event</option>
                  <option value="item">Item</option>
                  <option value="post">Post</option>
                </select>

                <p>Item</p>
                <select class="form-select hero-item-select" name="item_id"></select>
              </div>

              <button type="button" class="btn btn-warning new-hero-item">Add</button>
            </div>

            <div class="col-8">
              <p>Current Items</p>
              <div class="hero-items-container">
                @foreach($hero_items as $k => $item)
                  <div class="bg-alt-yellow flex-x extra-rounded p-4 mb-4 hero-item" style="align-items: center;">
                    <input type="hidden" name="hero_id[{{$k}}]" value="{{$item->id}}">
                    <span>#</span>
                    <input type="number" name="order[{{$k}}]" value="{{$item->order}}">
                    <span>Type</span>
                    <input type="text" name="type[{{$k}}]" value="{{$item->object_type}}">
                    <span>ID</span>
                    <input type="text" name="id[{{$k}}]" value="{{$item->object_id}}">
                  </div>
                @endforeach
              </div>
              <button type="submit" class="btn btn-warning">Save</button>
            </div>
          </div>
        </div>




      </div>

    </div>


  </div>

@endsection
