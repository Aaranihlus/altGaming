@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-5">
        <h1>Manage Titles</h1>

        @if(count($titles) > 0)
          <button class="btn btn-warning" type="button"><a href="/admin/title/create">New Title</a></button>
          <table class="table table-hover bg-alt-yellow rounded my-3">
            <thead>
              <tr>
                <th scope="col">Title</th>
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
        @else
          <div class="flex-y" style="align-items: center;">
            <h2>No Titles Found</h2>
            <button class="btn btn-warning" type="button"><a href="/admin/title/create">New Title</a></button>
          </div>
        @endif

      </div>


      <div class="col-5">
        <h1>Manage Badges</h1>

        @if(count($badges) > 0)
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
        @else
          <div class="flex-y" style="align-items: center;">
            <h2>No Badges Found</h2>
            <button class="btn btn-warning" type="button"><a href="/admin/badge/create">New Badge</a></button>
          </div>
        @endif

      </div>





    </div>


  </div>

@endsection
