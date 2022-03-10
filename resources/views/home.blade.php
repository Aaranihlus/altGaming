@extends('layouts.main')

@section('content')

  <div class="container mb-4">

    @if(!empty($highlighted_event))
    <div class="container-fluid flex-x extra-rounded" style="border: 2px solid #ffc107; width: 100%; justify-content: space-between; align-items: center; min-height: 20vh;">
      <img style="width: 200px; width: 400px;" src='{{ asset("storage/" . $highlighted_event->thumbnail) }}' />
      <div>
        <h1><span style="color: white;">{{ $highlighted_event->title }} Tickets</span> on sale <span style="color: white">NOW</span></h1>
        <h3>{{ \Carbon\Carbon::parse( $highlighted_event->start_date )->diffForHumans() }}</h3>
      </div>
      <div class="flex-y">
        <button type="button" class="btn btn-warning mb-4"><a class="link-dark" href="/shop/tickets">Get Tickets</a></button>
        <button type="button" class="btn btn-warning"><a class="link-dark" href="/altlan">More Info</a></button>
      </div>
    </div>
    <hr>
    @endif

    <div class="row" id="post-container">
      @foreach($posts as $post)
        @if ( $post->published == 1 )
          <x-content-template index="{{ $loop->index ?? 1 }}" :post="$post"> </x-content-template>
        @endif
      @endforeach
    </div>

  <div class="flex-x" style="justify-content: center">
    <button type="button" class="btn btn-warning load-more-posts-button" data-offset="{{ count($posts) }}">Load More</button>
    <i style="display: none;" id="loading-spinner" class="fa-2x fas fa-spinner fa-spin"></i>
  </div>

</div>

@endsection
