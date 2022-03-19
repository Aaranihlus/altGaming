@extends('layouts.main')

@section('content')
<div class="container">

  <div style="display: flex;" class="bg-alt-yellow p-3 extra-rounded">
    <div>
      <img class="img-fluid rounded" style="width: 7vw;" src="https://cdn.discordapp.com/avatars/{{ Auth::user()->id }}/{{ Auth::user()->avatar }}.webp" alt="Profile Picture">
    </div>

    <div class="mx-4">
      <div style="display:flex; align-items: center;">
        @if(!empty($user->badge_id))
          <img class="img-fluid rounded" style="width: 64px; margin-right: 8px; " src="{{ asset("storage/".$user->badge->image) }}">
        @endif
        <h1 style="margin-bottom: 0px;">{{ $user->username }}</h1>
      </div>
      @if(!empty($user->title_id))
        <hr>
        <p>{{ $user->title->name }}</p>
      @endif
    </div>

    <div class="mx-4">
      <p><i class="fab fa-discord"></i> {{ Auth::user()->username }}#{{ Auth::user()->discriminator }}</p>
      <p><i class="fab fa-twitch"></i> {{ $user->twitch_channel ?? "Not Set" }}</p>
      <p><i class="fab fa-youtube"></i> {{ $user->youtube_channel ?? "Not Set" }}</p>
    </div>

    <div class="mx-4">
      <h4>Member For</h4>
      <p>{{ \Carbon\Carbon::parse( $user->created_at )->longAbsoluteDiffForHumans() }}</p>
    </div>

  </div>

  <br>

  <div>
    <h1 class="text-2xl font-bold mb-2">Achievements</h1>
    @if(!empty($user->achievements))
      <div style="width: 100%; overflow-x: auto; white-space: nowrap;">
        @foreach($user->achievements as $achievement)
          <div class="mr-3" style="display: inline-block; text-align: center; margin-bottom: 4px;">
            <div class="bg-alt-yellow p-2 extra-rounded" style="width: 200px; max-width: 200px;">
              <p style="white-space: pre-wrap;">{{ $achievement->name }}</p>
              <img class="img-fluid rounded m-3" style="width: 96px;" src="{{ asset("storage/".$achievement->image) }}">
              <p style="white-space: pre-wrap;">{{ $achievement->description }}</p>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <p>None yet!</p>
    @endif
  </div>

</div>
@endsection
