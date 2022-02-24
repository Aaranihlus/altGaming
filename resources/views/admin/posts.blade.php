@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-11">
        <h1>Manage Posts</h1>

        @if(count($posts) > 0)
        <button class="btn btn-warning" type="button"><a href="/admin/posts/create">New Post</a></button>
        <hr>
        <table class="table table-hover bg-alt-yellow rounded my-3">
          <thead>
            <tr>
              <th scope="col">Title</th>
              <th>Type</th>
              <th>Created By</th>
              <th>Creation Date</th>
              <th>Published?</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach($posts as $post)
            <tr>
                <th scope="row"><span>{{$post->title}}</span></th>
                <th><span>{{ ucfirst($post->type) }}</span></th>
                <th><span>{{$post->user->username}}</span></th>
                <td><span>{{ \Carbon\Carbon::parse( $post->created_at )->toDayDateTimeString() }}</span></td>
                <td><span>{{ $post->published == 1 ? "Yes" : "No" }}</span></td>
                <td>
                  @if($post->published == 0)
                    <button class="btn btn-warning publish-button" type="button" data-id="{{$post->id}}">Publish</button>
                  @else
                    <button class="btn btn-warning hide-button" type="button" data-id="{{$post->id}}">Hide</button>
                  @endif
                  <button class="btn btn-warning edit-button" type="button"><a href="/admin/posts/edit/{{$post->id}}">Edit</a></button>
                  <button class="btn btn-warning delete-button" type="button" data-id="{{$post->id}}">Delete</button>
                </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      @else
        <div class="flex-y" style="align-items: center;">
          <h2>No Posts Found</h2>
          <button class="btn btn-warning mx-1" type="button"><a href="/admin/posts/create">New Post</a></button>
        </div>
      @endif



      </div>

    </div>

  </div>

@endsection
