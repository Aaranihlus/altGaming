@extends('layouts.main')

@section('content')
<div class="container">

  <div style="display: flex;" class="bg-alt-yellow p-3 extra-rounded">
    <div>
      @if(empty($user->profile_picture))
        <img class="img-fluid rounded" style="width: 9vw;" src="{{ asset('images/placeholder-big.png') }}" alt="Profile Picture">
      @else
        <img class="img-fluid rounded" style="width: 9vw;" src="https://cdn.discordapp.com/avatars/{{ Auth::user()->id }}/{{ Auth::user()->avatar }}.webp" alt="Profile Picture">
      @endif
    </div>

    <div class="mx-4">
      <div style="display:flex; align-items: center;">
        @if(!empty($user->badge_id))
          <img class="img-fluid rounded" style="width: 64px;" src="{{ asset("storage/".$user->badge->image) }}">
        @endif
        <h1 style="margin-left: 6px;">{{ $user->username }}</h1>
      </div>
      <hr>
      @if(!empty($user->title_id))
        <p>{{ $user->title->name }}</p>
      @endif
    </div>

    <div class="mx-4">
      <p><i class="fab fa-discord"></i> {{ $user->discord_id ?? "Not Set" }}</p>
      <p><i class="fab fa-twitch"></i> {{ $user->twitch_channel ?? "Not Set" }}</p>
      <p><i class="fab fa-youtube"></i> {{ $user->youtube_channel ?? "Not Set" }}</p>
    </div>

    <div class="mx-4">
      <h4>Member For</h4>
      <p>{{ \Carbon\Carbon::parse( $user->created_at )->longAbsoluteDiffForHumans() }}</p>
      @if(Auth::id() == $user->id)
        <p><i class="fas fa-edit"></i> <a href="/profile/edit">Edit Profile</a></p>
      @endif
    </div>

  </div>

  <br>

  <div>
    <h1 class="text-2xl font-bold mb-2">Achievements</h1>
    @if(!empty($user->achievements))
      <div style="width: 100%; overflow-x: scroll; white-space: nowrap;">
        @foreach($user->achievements as $achievement)
          <div class="mr-2" style="display: inline-block; text-align: center; margin-bottom: 4px;">
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

  <br>

  <div class="bg-alt-yellow p-3 extra-rounded">
    <h1 class="text-2xl font-bold mb-2">Merch Unlocks</h1>
    <p>None :D</p>
  </div>

  <br>

  <div class="bg-alt-yellow p-3 extra-rounded">
    <h1 class="text-2xl font-bold mb-2">Roles</h1>
    @foreach($user->roles as $role)
      <h3>- {{ $role->name }}</h3>
    @endforeach
  </div>

</div>
@endsection
