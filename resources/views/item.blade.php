@extends('layouts.main')

@section('content')

  <div class="container">

    <div class="row">

      <div class="col-5" style="display: flex; flex-direction: column;">
        @foreach( $item->images as $k => $i )
          @if ($k == 0 )
            <img class="rounded img-fluid my-2 shop-item-image" style="width: 100%;" id="image-0" src='{{asset("storage/$i->path")}}'>
          @else
            <img class="rounded img-fluid my-2 shop-item-image" style="width: 100%; display: none;" id="image-{{ $k }}" src='{{asset("storage/$i->path")}}'>
          @endif
        @endforeach

        @if (count($item->images) > 1)
          <div style="display: flex; justify-content: space-between;">
            <button type="button" class="btn btn-warning previous-image-button"><i class="fas fa-arrow-circle-left"></i> Previous</button>
            <button type="button" class="btn btn-warning next-image-button">Next <i class="fas fa-arrow-circle-right"></i></button>
          </div>
          <div class="container-fluid g-0">
            <div class="row">
              @foreach( $item->images as $k => $i )
                <div class="col-lg-4">
                  <img class="rounded img-fluid my-2 show-image-button @if($k == 0) highlighted @endif" style="width: 100%;" data-index="{{ $k }}" src='{{asset("storage/$i->path")}}'>
                </div>
              @endforeach
            </div>
          </div>
        @endif
      </div>

      <div class="col-7">
        <h1>{{ $item->name }}</h1>
        <hr>
        <h2>£{{ $item->price }}</h2>
        <p>{{ $item->description }}</p>
        <div style="display: flex;">
          <input class="form-control" style="width: 60px;" type="number" value="1" name="quantity" id="quantity" />
          <button type="button" class="btn btn-warning mx-3 add-to-cart" data-id="{{ $item->id }}"><i class="fas fa-cart-plus"></i> Add To Cart</button>
        </div>
      </div>

    </div>

  </div>

@endsection
