@extends('layouts.main')

@section('content')

<div class="container mb-4">

  @if(!empty($events))

  <div class="row" id="post-container">
    @foreach($events as $event)
      <x-event-template-alt :event="$event"> </x-event-template-alt>
    @endforeach
  </div>

  @if(count($events) == 6)
    <div class="flex-x" style="justify-content: center">
      <button type="button" class="btn btn-warning load-more-events-button" data-offset="{{ count($events) }}">Load More</button>
      <i style="display: none;" id="loading-spinner" class="fa-2x fas fa-spinner fa-spin"></i>
    </div>
  @endif

  @endif

</div>

@endsection
