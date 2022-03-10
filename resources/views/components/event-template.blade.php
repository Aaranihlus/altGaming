<div class="bg-alt-yellow extra-rounded p-3 flex-y col-6 mb-3">

  <div class="col">
    <img src='{{ asset("storage/" . $event->thumbnail) }}' alt="Thumbnail" class="img-fluid rounded" style="width: 50%;">
  </div>

  <div class="col d-flex flex-y" style="justify-content: space-between;">

      <div>
        <h1 style="color: white;">{{ $event->title }}</h1>
      </div>

      <div>
        <h4>£{{ $event->location }}</h4>
      </div>

      @if($event->type == "altlan")
        <div>
          <button type="button" class="btn btn-warning"><a class="link-dark" href="/shop/tickets">Get Tickets</a></button>
          <button type="button" class="btn btn-warning"><a class="link-dark" href="/altlan">More Info</a></button>
        </div>
      @endif

  </div>

</div>
