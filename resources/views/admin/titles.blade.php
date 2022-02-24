@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-11">
        <h1>Manage Titles</h1>
        <button class="btn btn-warning" type="button"><a href="/admin/title/create">New Title</a></button>

        <table class="table table-hover bg-alt-yellow rounded my-3">
          <thead>
            <tr>
              <th scope="col">Name</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($titles as $title)
            <tr>
                <td><span>{{ $title->name }}</span></td>
                <td>
                  <button type="button" class="btn btn-warning"><a class="link-dark" href="/admin/title/edit/{{ $title->id }}">Edit</a></button>
                  <button type="button" class="btn btn-warning delete-title-button" data-id="{{ $title->id }}">Delete</button>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>

      </div>

    </div>


  </div>

@endsection
