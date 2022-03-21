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
            @if($user->badge_id == $badge->id)
              <img class="img-fluid rounded select-badge highlighted" data-id="{{ $badge->id }}" style="width: 64px;" src="{{ asset("storage/" . $badge->image) }}">
            @else
              <img class="img-fluid rounded select-badge" data-id="{{ $badge->id }}" style="width: 64px;" src="{{ asset("storage/" . $badge->image) }}">
            @endif
          @endforeach
        </div>
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
