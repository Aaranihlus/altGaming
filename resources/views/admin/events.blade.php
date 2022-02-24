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
              <th scope="col">#</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($events as $event)
            <tr>
                <th scope="row"><span>{{$event->title}}</span></th>
                <td>
                  <span>View</span>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>

    </div>


  </div>

@endsection
