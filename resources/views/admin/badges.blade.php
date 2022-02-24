@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-11">
        <h1>Manage Badges</h1>
        <button class="btn btn-warning" type="button"><a href="/admin/badge/create">New Badge</a></button>

        <table class="table table-hover bg-alt-yellow rounded my-3">
          <thead>
            <tr>
              <th scope="col">Badge</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($badges as $badge)
            <tr>
                <td><img class="rounded img-fluid" style="width: 42px;" src="{{ asset("storage/" . $badge->image) }}"></td>
                <td>
                  <button type="button" class="btn btn-warning"><a class="link-dark" href="/admin/badge/edit/{{ $badge->id }}">Edit</a></button>
                  <button type="button" class="btn btn-warning delete-badge-button" data-id="{{ $badge->id }}">Delete</button>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>

    </div>


  </div>

@endsection
