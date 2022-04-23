@extends('layouts.main')

@section('content')

  <div class="container">

    <div class="row">

      <div class="col-5 flex-y">
        @foreach( $item->images as $k => $i )
          <img class="extra-rounded img-fluid my-2 shop-item-image max-width" @if($k != 0) style="display: none;" @endif id="image-{{ $k }}" src='{{asset("storage/$i->path")}}'>
        @endforeach

        @if (count($item->images) > 1)
          <div class="flex-x" style="justify-content: space-between;">
            <button type="button" class="btn btn-warning previous-image-button"><i class="fas fa-arrow-circle-left"></i> Previous</button>
            <button type="button" class="btn btn-warning next-image-button">Next <i class="fas fa-arrow-circle-right"></i></button>
          </div>
          <div class="container-fluid g-0">
            <div class="row">
              @foreach( $item->images as $k => $i )
                <div class="col-lg-4">
                  <img class="rounded img-fluid my-2 show-image-button max-width @if($k == 0) highlighted @endif" data-index="{{ $k }}" src='{{asset("storage/$i->path")}}'>
                </div>
              @endforeach
            </div>
          </div>
        @endif
      </div>

      <div class="col-7">
        <h1 id="item-name-header">{{ $item->name }}</h1>
        <hr>
        <p>{{ $item->description }}</p>
        @if (count($item->groups) > 0)
          @foreach($item->groups as $group)
            <p class="mb-1">Choose {{ $group->name }}</p>
            <select class="form-select mb-4 item-option-select" style="width: 50%;">
              <option value=""></option>
            @foreach($group->options as $option)
              <option value="{{ $option->id }}" data-price-mod="{{ $option->price_modifier }}">{{ $option->name }} @if(!empty($option->price_modifier)) (£{{ $option->price_modifier }})@endif</option>
            @endforeach
            </select>
          @endforeach
        @endif
        <h2>£<span id="item-price">{{ $item->price }}</span></h2>
        <p style="display: none;" id="base_price">{{ $item->price }}</p>
        <div class="flex-x">
          <input class="form-control" style="width: 60px;" type="number" value="1" name="quantity" id="quantity" />
          <button type="button" class="btn btn-warning mx-3 add-to-cart" data-id="{{ $item->id }}"><i class="fas fa-cart-plus"></i> Add To Cart</button>
        </div>
      </div>

    </div>

  </div>

@endsection
