<div class="col-3 mb-3">
  <div class="bg-alt-yellow extra-rounded p-2 flex-y" style="height: 375px;">

    <div class="col extra-rounded" style="flex-basis:50% background-attachment: unset; background-position: center; background-repeat: no-repeat; background-size: cover; background-image: url({{ asset('storage/' . $item->images[0]->path) }});"></div>

    <div class="col d-flex flex-y" style="justify-content: space-between;">

      <div class="my-1">
        <h1 style="color: white; font-size: 1.5vw; height: 50px; margin-bottom: 0px;">{{ $item->name }}</h1>
      </div>

      <div>
        <h4>£{{ $item->price }}</h4>
      </div>

      <div>
        <button type="button" class="btn btn-warning" style="width:100%;"><a class="link-dark" href="/shop/view/{{ $item->slug }}">View</a></button>
      </div>

    </div>

  </div>
</div>
