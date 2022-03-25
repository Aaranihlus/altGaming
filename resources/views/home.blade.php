@extends('layouts.main')

@section('content')

  @if( $heroEnabled )

    <div class="container-fluid g-0 m-0 flex-x mb-4" style="justify-content: center; align-items: center; border-bottom: 2px solid #ffc107;">

      @foreach($heroItems as $item)
        <x-hero-banner-item index="{{ $loop->index }}" :item="$item"></x-hero-banner-item>
      @endforeach

      @if(count($heroItems) > 1)
        <div id="hero-left-button" class="mx-3" style="font-size: 2em; cursor: pointer; position: absolute; left: 1vh;"><i class="fas fa-angle-left"></i></div>
        <div id="hero-right-button" class="mx-3" style="font-size: 2em; cursor: pointer; position: absolute; right: 1vw;"><i class="fas fa-angle-right"></i></div>

        <div class="container-fluid g-0 m-0 flex-x" style="align-items: center; justify-content: center; position: absolute; top: 46vh;">
          @foreach($heroItems as $item)
            <button type="button" class="btn btn-warning hero-button mx-2" style="width: 50px;" data-index="{{ $loop->index }}"></button>
          @endforeach
        </div>
      @endif

    </div>

  @else
    <div class="container m-4"></div>
  @endif


  <div class="container mb-4">

    <div class="row" id="post-container">
      @foreach($posts as $post)
        @if ( $post->published == 1 )
          <x-content-template-alt index="{{ $loop->index ?? 1 }}" :post="$post"> </x-content-template-alt>
        @endif
      @endforeach
    </div>

  <div class="flex-x" style="justify-content: center">
    <button type="button" class="btn btn-warning load-more-posts-button" data-offset="{{ count($posts) }}">Load More</button>
    <i style="display: none;" id="loading-spinner" class="fa-2x fas fa-spinner fa-spin"></i>
  </div>

</div>

@endsection
