@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-11">
        <h1>Manage Achievements</h1>
        <button class="btn btn-warning" type="button"><a href="/admin/achievement/create">New Achievement</a></button>

        <table class="table table-hover bg-alt-yellow rounded my-3">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($achievements as $achievement)
            <tr>
                <td><span>{{ $achievement->name }}</span></td>
                <td>
                  <button type="button" class="btn btn-warning"><a class="link-dark" href="/admin/achievement/edit/{{ $achievement->id }}">Edit</a></button>
                  <button type="button" class="btn btn-warning delete-achievement-button" data-id="{{ $achievement->id }}">Delete</button>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>

    </div>


  </div>

@endsection
