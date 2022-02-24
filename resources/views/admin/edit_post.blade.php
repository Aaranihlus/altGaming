@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-11">

        <h1>Edit Post</h1>

        <form method="POST" action="/admin/posts/update/{{ $post->id }}" style="width: 75%;" enctype="multipart/form-data">

          @csrf
          <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $post->title }}">
          </div>

          <div>
            <textarea id="editor" name="content">{{ $post->content }}</textarea>
          </div>

          <hr>

          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <input type="text" class="form-control" id="description" name="description" value="{{ $post->description }}">
          </div>

          <div class="mb-3">
            <label for="thumbnail" class="form-label">Current Thumbnail</label>
            <br>
            <img style="width: 300px; height: 300px;" src="{{ asset("storage/$post->thumbnail") }}">
          </div>

          <div class="mb-3">
            <label for="new_thumbnail" class="form-label">New Thumbnail</label>
            <input type="file" class="form-control" id="new_thumbnail" name="new_thumbnail">
          </div>

          <button type="submit" class="btn btn-warning">Update</button>
        </div>

      </div>

    </div>

    @endsection
