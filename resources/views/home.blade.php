@extends('layouts.main')

@section('content')

  <div class="container mb-4">

    @if(!empty($highlighted_event))
    <div class="container-fluid flex-x extra-rounded g-0" style="border: 2px solid #ffc107; width: 100%; justify-content: space-between; align-items: center; min-height: 25vh;">

      <div style="
        background-image: url({{ asset('storage/' . $highlighted_event->thumbnail) }});
        /* background-attachment: unset; */
        background-position: left;
        background-repeat: no-repeat;
        min-height: 25vh;
        width: 100%;
        background-size: cover;
        flex-basis: 50%;
        border-collapse: separate;
        border-bottom-left-radius: 12px;
        border-top-left-radius: 12px;
      "></div>

      <div style="flex-basis: 50%;" class="p-4">
        <h1><span style="color: white;">{{ $highlighted_event->title }} Tickets</span> on sale <span style="color: white">NOW</span></h1>
        <h3>{{ \Carbon\Carbon::parse( $highlighted_event->start_date )->diffForHumans() }}</h3>
        <div>
          <button type="button" class="btn btn-warning"><a class="link-dark" href="/shop/tickets">Get Tickets</a></button>
          <button type="button" class="btn btn-warning"><a class="link-dark" href="/altlan">More Info</a></button>
        </div>
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
