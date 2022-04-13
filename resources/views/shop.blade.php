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
        @if( $item->visible == 1 )
          <x-item-template :item="$item"></x-item-template>
        @endif
      @endforeach
    </div>

</div>

@endsection
