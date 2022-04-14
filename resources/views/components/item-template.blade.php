<div class="col-lg-3 col-xl-3 col-xs-12 col-md-12 col-sm-12 mb-3">
  <div class="bg-alt-yellow extra-rounded p-2 flex-y" style="height: 450px; border: 2px solid #ffc107; box-shadow: 3px 3px;">
      <div class="extra-rounded" style="flex-basis: 75%; background-attachment: unset; background-position: center; background-repeat: no-repeat; background-size: cover; background-image: url({{ asset('storage/' . $item->images[0]->path) }});"></div>
      <h1 class="my-1" style="color: white; font-size: 1.5vw; margin-bottom: 0px; flex-basis: 25%;">{{ $item->name }}</h1>
      <h4>£{{ $item->price }}</h4>
      <button type="button" class="btn btn-warning" style="width:100%;"><a class="link-dark" href="/shop/view/{{ $item->slug }}">View</a></button>
  </div>
</div>
