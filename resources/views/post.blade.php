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
          <div class="container" style="min-height: 30vh;">
            <div class="iframe-container" style="overflow: hidden; padding-top: 56.25%; position: relative;">
              <iframe loading="lazy" src="{{ "https://www.youtube.com/embed/" . $post->youtube_link }}" style="border: 0; height: 100%; left: 0; position: absolute; top: 0; width: 100%;"></iframe>
            </div>
          </div>
        @endif
        <br>
        <button type="button" class="btn btn-warning"><a class="link-dark" href="http://feeds.feedburner.com/altgaming-podcast">Subscribe</a></button>
      </div>
    @endif

    @if($post->type == "blog")
      <hr>
    @else
      <br>
    @endif

    <div>
      {!! $post->content !!}
    </div>

    <hr>

    <div class="flex-x">

      <img class="img-fluid rounded me-2" style="width: 64px;" src="https://cdn.discordapp.com/avatars/{{ $post->user->id }}/{{ $post->user->avatar }}.webp" alt="Profile Picture">

      <div>
        <h5>Posted By {{ $post->user->username }}</h5>
        @if(!empty($post->user->title->name))
          <h6>{{ $post->user->title->name }}</h6>
        @endif
      </div>
    </div>

    <div class="flex-y" style="margin-bottom: 2vh;">
      <hr>
      <br>
      <h2>Comments</h2>
      @if(count($post->comments) == 0)
        <p>No comments yet, be the first!</p>
      @else
        @foreach($post->comments as $comment)
          <div class="flex-x bg-alt-yellow p-2 rounded" style="align-items: center; width: 100%;">
            @if(empty($comment->user->profile_picture))
              <img class="rounded me-2" style="width: 64px;" src="{{ asset('images/placeholder-small.png') }}" alt="Profile Picture">
            @else
              <img class="rounded me-2" style="width: 64px;" src='{{ asset("storage/" . $comment->user->profile_picture) }}' alt="Profile Picture">
            @endif
            <div class="flex-y" style="width: 100%;">
              <div class="flex-x" style="margin-right: 8px; align-items: center; justify-content: space-between; width: 100%;">
                <div><span>{{ $comment->user->username }} - {{ \Carbon\Carbon::parse( $comment->created_at )->diffForHumans() }}</span></div>
                @if( (Auth::id() AND Auth::id() == $comment->user->id) OR (!empty(auth()->user()->id) AND auth()->user()->roles->contains('name', 'Admin')) )
                  <div><span class="delete-comment-button" data-id="{{ $comment->id }}" style="cursor: pointer; font-size: 0.9rem;"><i class="far fa-times-circle"></i> Delete</span></div>
                @endif
              </div>
              <p>{{ $comment->comment }}</p>
            </div>
          </div>
        @endforeach
        <br>
      @endif

      @if(Auth::id())
      <div class="flex-x">
        <input type="text" class="form-control" id="comment" name="comment" style="width: 50%; margin-right: 6px;" placeholder="Leave a comment">
        <button type="button" class="btn btn-warning post-comment-button" data-post-id="{{ $post->id }}">Comment</button>
      </div>
      @endif
    </div>


  </div>

@endsection
