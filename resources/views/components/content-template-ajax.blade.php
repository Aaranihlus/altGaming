<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 mb-4">

  <div class="content-template bg-alt-yellow extra-rounded flex-y" style="border: 1px solid #ffc107; width: 100%;">

      <div class="g-0" style="flex-basis: 45%;">
        <img src='{{ asset("storage/" . $post->thumbnail) }}' alt="Thumbnail" class="img-fluid sub-image-border">
      </div>

      <div class="p-3 flex-y" style="justify-content: space-between; flex-basis: 55%;">

        <div>
          <h1 class="clip-text-2" style="color: white; text-shadow: 3px 3px #1d1800;">{{ $post->title }}</h1>
          <div class="flex-x" style="align-content: center; justify-content: flex-start; align-items: flex-start;">
            <div class="badge bg-warning"><a href="/{{ $post->type }}">{{ ucfirst($post->type) }}</a></div>
            <h6 style="margin-left: 8px;">{{ \Carbon\Carbon::parse( $post->created_at )->diffForHumans() }}</h6>
          </div>
        </div>

        <div>
          <p class="clip-text-4">{{ $post->description }}</p>
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
              @if(!empty($post->user->title->name))
                <h6>{{ $post->user->title->name ?? "" }}</h6>
              @endif
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
