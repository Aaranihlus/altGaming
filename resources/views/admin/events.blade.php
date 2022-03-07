@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-11">
        <h1>Manage Events</h1>
        <button class="btn btn-warning" type="button"><a href="/admin/event/create">New Event</a></button>

        <table class="table table-hover bg-alt-yellow rounded my-3">
          <thead>
            <tr>
              <th scope="col">Event</th>
              <th>Location</th>
              <th>Start Date</th>
              <th>Date Created</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($events as $event)
            <tr>
                <td><span>{{ $event->title }}</span></td>
                <td><span>{{ $event->location }}</span></td>
                <td><span>{{ $event->start_date }}</span></td>
                <td><span>{{ $event->created_at }}</span></td>
                <td>
                  <button class="btn btn-warning" type="button"><a href="/admin/event/edit/{{ $event->id }}">Edit</a></button>
                  @if($event->type == "altlan")
                    <button class="btn btn-warning" type="button"><a href="/admin/event/tickets/{{ $event->id }}">View Tickets Sold</a></button>
                  @endif
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>

    </div>


  </div>

@endsection
