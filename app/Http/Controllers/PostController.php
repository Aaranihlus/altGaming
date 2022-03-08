<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller {

  public function publish (Request $request) {
    $post = Post::find($request->id);
    $post->published = 1;
    $post->save();
    return response()->json(['success' => true]);
  }

  public function delete (Request $request) {
    $post = Post::find($request->id);
    $post->delete();
    return response()->json(['success' => true]);
  }

  public function hide (Request $request) {
    $post = Post::find($request->id);
    $post->published = 0;
    $post->save();
    return response()->json(['success' => true]);
  }

  public function create () {
    return view('admin.create_post');
  }

  public function edit (Post $post) {
    return view('admin.edit_post', [
      'post' => $post
    ]);
  }

  public function update ($id, Request $request) {

    $slug = \Str::slug($request->title);

    $post = Post::find($id);
    $post->title = $request->title;
    $post->description = $request->description;
    $post->content = $request->content;
    $post->slug = $slug;
    $post->youtube_link = $request->youtube_link;
    $post->spotify_link = $request->spotify_link;
    $post->apple_link = $request->apple_link;

    $published = 0;
    if ( $request->publish == "on" ) {
      $published = 1;
    }

    $post->published = $published;

    if ( isset($request->new_thumbnail) ) {
      $path = $request->file('new_thumbnail')->store('post_thumbnails');
      $post->thumbnail = $path;
    }

    $post->save();

    return redirect("/admin/posts")->with('success','Post successfully updated!');

  }


  public function store( Request $request ) {

    $request->validate([
        'title' => ['required', 'string', 'max:255']
        //'description' => ['required', 'string', 'max:255']
    ]);

    $slug = \Str::slug($request->title);

    $published = 0;
    if ( $request->publish == "on" ) {
      $published = 1;
    }

    $thumbnail_path = $request->file('thumbnail')->store('post_thumbnails');

    $audio_file_path = null;
    if ( isset($request->audio_file) ) {
      $audio_file_path = $request->file('audio_file')->store('podcast_audio_files');
    }

    $post = Post::create([
        'title' => $request->title,
        'description' => $request->description,
        'content' => $request->content,
        'type' => $request->type,
        'user_id' => Auth::id(),
        'published' => $published,
        'slug' => $slug,
        'thumbnail' => $thumbnail_path,
        'spotify_link' => $request->spotify_link,
        'youtube_link' => $request->youtube_link,
        'apple_link' => $request->apple_link,
        'audio_file' => $audio_file_path
    ]);

    return redirect("/admin/posts")->with('success','Post successfully created!');

  }

}
