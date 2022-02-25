@extends('layouts.main')

@section('content')

  <div class="container-fluid">

    <div class="row">

      @include('admin/menu')

      <div class="col-11">

        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="/admin/posts/store" style="width: 75%;" enctype="multipart/form-data">
          @csrf
        <h1>Create New Post</h1>

        <div class="mb-3">
          <label class="form-label">Post Type</label>

          <div class="form-check">
            <input class="form-check-input post_type_radio" type="radio" name="type" id="podcast" value="podcast">
            <label class="form-check-label" for="podcast">
              Podcast
            </label>
          </div>

          <div class="form-check">
            <input class="form-check-input post_type_radio" type="radio" name="type" id="blog" value="blog">
            <label class="form-check-label" for="blog">
              Blog
            </label>
          </div>
        </div>

        <hr>

        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" name="title">
        </div>

        <div class="mb-3 blog_only" style="display: none;">
          <label for="editor" class="form-label">Blog Post Content</label>
          <textarea id="editor" name="content"></textarea>
        </div>

        <div class="mb-3 podcast_only" style="display: none;">
          <label for="audio_file" class="form-label">Podcast Audio File</label>
          <input type="file" class="form-control" id="audio_file" name="audio_file">
        </div>

        <div class="mb-3 podcast_only" style="display: none;">
          <label for="spotify_link" class="form-label">Spotify Link</label>
          <input type="text" class="form-control" id="spotify_link" name="spotify_link">
        </div>

        <div class="mb-3 podcast_only" style="display: none;">
          <label for="apple_link" class="form-label">Apple Link</label>
          <input type="text" class="form-control" id="apple_link" name="apple_link">
        </div>

        <div class="mb-3 podcast_only" style="display: none;">
          <label for="youtube_link" class="form-label">Youtube ID</label>
          <input type="text" class="form-control" id="youtube_link" name="youtube_link">
        </div>

        <div class="mb-3">
          <label for="description" class="form-label">Description</label>
          <input type="text" class="form-control" id="description" name="description">
        </div>

        <div class="mb-3">
          <label for="thumbnail" class="form-label">Thumbnail</label>
          <input type="file" class="form-control" id="thumbnail" name="thumbnail">
        </div>

        <div class="mb-3">
          <label for="publish" class="form-label">Visible Immediately?</label>
          <input type="checkbox" id="publish" name="publish">
        </div>

        <button type="submit" class="btn btn-warning">Create</button>
      </div>

    </div>


  </div>

@endsection
