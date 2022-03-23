<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-xs-12 mb-4 animate__animated animate__fadeIn">

  <div class="content-template extra-rounded flex-y" style="border: 1px solid #ffc107; height: 350px;
      background-image: url({{ asset('storage/' . $post->thumbnail) }});
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;">

      <div class="p-3 flex-y extra-rounded" style="justify-content: space-between; background: rgba(0, 0, 0, .8); height: 100%;">

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
            <img class="img-fluid rounded me-2" style="width: 75px;" src="https://cdn.discordapp.com/avatars/{{ $post->user->id }}/{{ $post->user->avatar }}.webp" alt="Profile Picture">

            <div>
              <h5><a href="/profile/{{ $post->user->slug }}">By {{ $post->user->username }}</a></h5>
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
