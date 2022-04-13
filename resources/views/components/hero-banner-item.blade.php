<div data-hero-index="{{ $index }}" class="content-template bg-alt-yellow flex-y hero-item animate__animated animate__fadeIn" style="min-height: 40vh; width: 100%;

               @if($index != 0) display: none; @endif

               @if(!empty($item->custom_image))
                background-image: url({{ asset('storage/' . $item->custom_image) }});
               @elseif($item->thumbnail)
                background-image: url({{ asset('storage/' . $item->thumbnail) }});
               @else
                background-image: url({{ asset('storage/' . $item->images[0]->path) }});
               @endif

              background-attachment: unset;
              background-position: center;
              background-repeat: no-repeat;
              background-size: cover;
              animation: fadeIn 1s, animatedBackground 60s linear infinite alternate">

  <div style="height: 40vh; min-height: 100%; background: rgba(0, 0, 0, .6);" class="flex-y center-x center-y">
    <h1 style="text-shadow: 5px 5px #1d1800; font-size: 4vw; font-weight: bold; color: white;">{{ $item->name ?? $item->title }}</h1>
    @if(!empty($item->custom_text))
      <h3 style="text-shadow: 3px 3px #1d1800;">{{ $item->custom_text }}</h3>
    @endif

    @if(isset($item->alt_lan_number))
      <br>
      <div class="flex-x">
        <button type="submit" class="btn btn-warning mx-2"><a href="/shop/tickets"><i class="fas fa-ticket-alt"></i> Get Tickets</a></button>
        <button type="submit" class="btn btn-warning mx-2"><a href="/altlan"><i class="fas fa-info-circle"></i> More Info</a></button>
      </div>
    @endif
  </div>
</div>
