@extends('layouts.main')

@section('content')

  <div class="container mb-4">

    <div class="row">
      @foreach($posts as $post)
        @if ( $post->published == 1 )
          <x-content-template
          id="{{ $post->id }}"
          index="{{ $loop->index }}"
          title="{{ $post->title }}"
          created="{{ $post->created_at }}"
          slug="{{ $post->slug }}"
          thumbnail='{{ asset("storage/$post->thumbnail") }}'
          type="{{ $post->type }}"
          description="{{ $post->description }}"
          uploaded-by="{{ $post->user->username }}"
          uploaded-by-title="{{ $post->user->title->name ?? '' }}"
          uploaded-by-image='{{ $post->user->profile_picture }}'
          uploaded-by-slug='{{ $post->user->slug }}'>
        </x-content-template>
      @endif
    @endforeach
  </div>

  <div class="flex-x" style="justify-content: center">
    <button type="button" class="btn btn-warning load-more-posts-button" data-offset="{{ count($posts) }}">Load More</button>
  </div>

</div>

@endsection
