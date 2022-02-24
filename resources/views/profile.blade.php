@extends('layouts.main')

@section('content')
<div class="container">

  <div style="display: flex;" class="bg-alt-yellow p-3 extra-rounded">
    <div>
      @if(empty($user->profile_picture))
        <img class="img-fluid rounded" style="width: 9vw;" src="{{ asset('images/placeholder-big.png') }}" alt="Profile Picture">
      @else
        <img class="img-fluid rounded" style="width: 9vw;" src="{{ asset("storage/$user->profile_picture") }}">
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
      <p><i class="fab fa-discord"></i> Chungus#6866</p>
      <p><i class="fab fa-twitch"></i> achungus</p>
      <p><i class="fab fa-youtube"></i> Not Set</p>
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

  <div class="bg-alt-yellow p-3 extra-rounded">
    <h1 class="text-2xl font-bold mb-2">altLAN Attendance</h1>
    <p>None :D</p>
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
