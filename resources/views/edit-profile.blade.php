@extends('layouts.main')

@section('content')

  <div class="container">

    <h1>Profile Info</h1>

    <hr>

    <form method="POST" action="/profile/update" enctype="multipart/form-data">
      @csrf

      <div class="mb-3">
        <label for="profile_visible" class="form-label">Profile Visible?</label>
        <input @if($user->profile_visible == 1) checked @endif type="checkbox" id="profile_visible" name="profile_visible">
      </div>

      <div class="mb-3">
        <label for="title" class="form-label">Choose Title</label>
        <select name="title_id" class="form-select" id="title_id">
          <option></option>
          @foreach($user->titles as $title)
              @if($title->id == $user->title_id)
                <option selected value="{{ $title->id }}">{{ $title->name }}</option>
              @else
                <option value="{{ $title->id }}">{{ $title->name }}</option>
              @endif
          @endforeach
        </select>
      </div>

      <div class="mb-3">
        <label for="badge" class="form-label">Choose Badge</label>
        <input type="hidden" value="{{ $user->badge_id }}" name="badge_id" id="badge_id">
        <div class="badge-display" style="display: flex;">
          @foreach($user->badges as $badge)
            @if($user->badge_id == $role->badge->id)
              <img class="img-fluid rounded select-badge highlighted" data-id="{{ $role->badge->id }}" style="width: 64px;" src="{{ asset("storage/" . $role->badge->image) }}">
            @else
              <img class="img-fluid rounded select-badge" data-id="{{ $role->badge->id }}" style="width: 64px;" src="{{ asset("storage/" . $role->badge->image) }}">
            @endif
          @endforeach
        </div>
      </div>

      <div class="mb-3">
        <label class="form-label">Current Profile Picture</label>
        <br>
        @if(empty($user->profile_picture))
          <img class="img-fluid rounded" style="width: 128px;" src="{{ asset('images/placeholder-big.png') }}" alt="Profile Picture">
        @else
          <img class="img-fluid rounded" style="width: 128px; height: 128px;" src="{{ asset("storage/$user->profile_picture") }}">
        @endif
      </div>

      <div class="mb-3">
        <label for="profile_picture" class="form-label">New Profile Picture</label>
        <input type="file" class="form-control" id="profile_picture" name="profile_picture">
      </div>

      <div class="mb-3">
        <label for="discord_id" class="form-label">Discord ID</label>
        <input type="text" class="form-control" id="discord_id" name="discord_id">
      </div>

      <div class="mb-3">
        <label for="youtube_channel" class="form-label">Youtube Channel</label>
        <input type="text" class="form-control" id="youtube_channel" name="youtube_channel">
      </div>

      <div class="mb-3">
        <label for="twitch_channel" class="form-label">Twitch Channel</label>
        <input type="text" class="form-control" id="twitch_channel" name="twitch_channel">
      </div>

      <button type="submit" class="btn btn-warning mx-1">Update Profile</button>

    </form>

  </div>

@endsection
