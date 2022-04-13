@extends('layouts.main')

@section('content')

  <div class="container mb-4">

    <div class="row" id="post-container">
      @foreach($posts as $post)
        @if ( $post->published == 1 )
          <x-content-template-alt index="{{ $loop->index ?? 1 }}" :post="$post"> </x-content-template-alt>
      @endif
    @endforeach
  </div>

  @if(count($posts) == 9)
    <div class="flex-x" style="justify-content: center">
      <button type="button" class="btn btn-warning load-more-posts-button" data-offset="{{ count($posts) }}" data-type="{{ $type }}">Load More</button>
      <i style="display: none;" id="loading-spinner" class="fa-2x fas fa-spinner fa-spin"></i>
    </div>
  @endif

</div>

@endsection
