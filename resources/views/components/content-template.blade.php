@if($index == 0)
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-xs-12 mb-4">
@elseif($index == 1 OR $index == 2)
  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-xs-12 mb-4">
@else
  <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 mb-4">
@endif

  <div class="content-template bg-alt-yellow extra-rounded @if($index == 0) d-lg-flex d-xl-flex @else flex-y @endif" style="border: 2px solid #ffc107; width: 100%;">

      @if($index == 0)
        <div class="g-0" style="flex-basis: 50%;">
      @else
        <div class="g-0" style="flex-basis: 45%; height: 45%; max-height: 45%;">
      @endif
        <img src='{{ asset("storage/" . $post->thumbnail) }}' alt="Thumbnail" class="img-fluid @if($index == 0) main-image-border @else sub-image-border @endif" style="width: 100%; object-fit: cover; height: 100%;">
      </div>

      @if($index == 0)
        <div class="p-3 flex-y" style="justify-content: space-between; flex-basis: 50%;">
      @else
        <div class="p-3 flex-y" style="justify-content: space-between; flex-basis: 55%;">
      @endif

        <div>
          <h1 class="clip-text-2 post-title">{{ $post->title }}</h1>
          <div class="flex-x" style="align-content: center; justify-content: flex-start; align-items: flex-start;">
            <div class="badge bg-warning"><a href="/{{ $post->type }}">{{ ucfirst($post->type) }}</a></div>
            <h6 style="margin-left: 8px;">{{ \Carbon\Carbon::parse( $post->created_at )->diffForHumans() }}</h6>
          </div>
        </div>

        <div>
          <p class="clip-text-4" style="min-height: 48px;">{{ $post->description }}</p>
        </div>

        <div class="flex-x" style="justify-content: space-between; align-items: flex-end;">

          <div style="display: flex;">
            @if(empty($post->user->profile_picture))
              <img class="img-fluid rounded me-2" style="width: 75px;" src="{{ asset('images/placeholder-small.png') }}" alt="Profile Picture">
            @else
              <img class="img-fluid rounded me-2" style="width: 75px;" src="{{ asset("storage/" . $post->user->profile_picture) }}" alt="Profile Picture">
            @endif

            <div>
              <h5><a href="/profile/{{ $post->user->slug }}">{{ $post->user->username }}</a></h5>
              <h6>{{ $post->user->title->name ?? "" }}</h6>
            </div>
          </div>

          <button type="button" class="btn btn-warning">
            <a href="/{{ $post->type }}/{{ $post->slug }}">
              @if($post->type == "podcast")
                Listen Now
              @else
                Read More
              @endif
            </a>
          </button>

        </div>

      </div>

  </div>

</div>
