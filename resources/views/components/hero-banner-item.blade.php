<div data-hero-index="{{ $index }}" class="content-template bg-alt-yellow flex-y hero-item animate__animated animate__fadeIn"
               style="min-height: 40vh; width: 100%;
               @if($index != 0) display: none; @endif
               @if($item->thumbnail) background-image: url({{ asset('storage/' . $item->thumbnail) }});
               @else background-image: url({{ asset('storage/' . $item->images[0]->path) }}); @endif
              background-attachment: unset;
              background-position: center;
              background-repeat: no-repeat;
              background-size: cover;
              animation: animatedBackground 60s linear infinite alternate">

  <div style="height: 40vh; min-height: 100%; background: rgba(0, 0, 0, .8); align-items: center; justify-content: center;" class="flex-x">
    <h1 style="text-shadow: 3px 3px #1d1800;
    font-size: 4rem;
    font-weight: bold;
    color: white;
    font-family: boldfont;">{{ $item->name ?? $item->title }}</h1>
  </div>
</div>
