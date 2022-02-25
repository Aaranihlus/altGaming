@extends('layouts.main')

@section('content')

  <div class="container mb-4">

    <div class="shop-categories flex-x mb-4" style="justify-content: space-evenly;">
      <h4>Filter By:</h4>

      @if($filter == "all")
        <h4><a class="shop-category-highlighted" href="/shop/all">All</a></h4>
      @else
        <h4><a class="shop-category" href="/shop/all">All</a></h4>
      @endif

      @if($filter == "tickets")
        <h4><a class="shop-category-highlighted" href="/shop/tickets">Tickets</a></h4>
      @else
        <h4><a class="shop-category" href="/shop/tickets">Tickets</a></h4>
      @endif

      @if($filter == "merch")
        <h4><a class="shop-category-highlighted" href="/shop/merch">Merch</a></h4>
      @else
        <h4><a class="shop-category" href="/shop/merch">Merch</a></h4>
      @endif

    </div>

    <div class="row">

      @foreach( $items as $item )
        <div class="col-3 mb-3" style="height: 100%;">
          <x-item-template
          id="{{ $item->id }}"
          name="{{ $item->name }}"
          price="{{ $item->price }}"
          slug="{{ $item->slug }}"
          alt-ticket="{{ $item->is_alt_ticket }}"
          thumbnail='{{ asset("storage/" . $item->images[0]->path) }}'>
        </x-item-template>
      </div>
    @endforeach

  </div>

</div>

@endsection
