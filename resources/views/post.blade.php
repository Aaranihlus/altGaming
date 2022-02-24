@extends('layouts.main')

@section('content')

  <div class="container">

    <!--<img src='{{asset("storage/$post->thumbnail")}}'>-->

    <h1 style="text-align: center;">{{ $post->title }}</h1>

    <h6 style="text-align: center;">{{ \Carbon\Carbon::parse( $post->created_at )->diffForHumans() }}</h6>

    @if($post->type == "podcast")
      <p>
        {{ $post->description }}
      </p>
    @endif

    @if($post->type == "blog")
      <hr>
    @endif


    @if ( !empty($post->audio_file) )
    <div>
      <audio controls src="{{ asset("storage/" . $post->audio_file) }}">Your browser does not support the <code>audio</code> element.</audio>
    </div>
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
        <h6>Engineer</h6>
      </div>
    </div>

  </div>

@endsection
