@extends('layouts.main')

@section('content')

  <div class="container mb-4">

    @if(!empty($highlighted_event))
    <div class="container-fluid">

      <p>{{ $highlighted_event->title }}</p>
      <p>{{ $highlighted_event->start_date }}</p>

      <img src='{{ asset("storage/" . $highlighted_event->thumbnail) }}' />

      <div>
        <button type="button" class="btn btn-warning"><a class="link-dark" href="/shop/tickets">Get Tickets</a></button>
        <button type="button" class="btn btn-warning"><a class="link-dark" href="/altlan">More Info</a></button>
      </div>

    </div>
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
