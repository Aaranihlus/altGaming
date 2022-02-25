@extends('layouts.main')

@section('content')

  <div class="container">

    <h1 style="text-align: center;">{{ $post->title }}</h1>

    <h6 style="text-align: center;">{{ \Carbon\Carbon::parse( $post->created_at )->diffForHumans() }}</h6>

    @if($post->type == "podcast")
      <div class="flex-y" style="align-items: center;">
        <p style="text-align: center;">
          {{ $post->description }}
        </p>
        <br>
        @if ( !empty($post->audio_file) )
        <div>
          <audio controls src="{{ asset("storage/" . $post->audio_file) }}">Your browser does not support the <code>audio</code> element.</audio>
        </div>
        @endif
        <br>
        @if ( !empty($post->youtube_link) )
          <iframe width="720" height="480" src="{{ "https://www.youtube.com/embed/" . $post->youtube_link }}"></iframe>
        @endif
        <br>
        <button type="button" class="btn btn-warning"><a class="link-dark" href="http://feeds.feedburner.com/altgaming-podcast">Subscribe</a></button>
      </div>
    @endif

    @if($post->type == "blog")
      <hr>
    @endif

    <div>
      {!! $post->content !!}
    </div>

    <hr>

    <div style="display: flex;">

      @if(empty($uploadedByImage))
        <img class="img-fluid rounded me-2" style="width: 64px;" src="{{ asset('images/placeholder-small.png') }}" alt="Profile Picture">
      @else
        <img class="rounded me-2" style="width: 64px;" src='{{ asset("storage/" . $post->user->profile_picture) }}' alt="Profile Picture">
      @endif

      <div>
        <h5>By {{ $post->user->username }}</h5>
        @if(!empty($post->user->title->name))
          <h6>{{ $post->user->title->name }}</h6>
        @endif
      </div>
    </div>

  </div>

@endsection
