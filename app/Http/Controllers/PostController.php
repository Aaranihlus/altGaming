<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;
use Intervention\Image\ImageManagerStatic;

class PostController extends Controller {

  public function publish (Request $request) {
    $post = Post::find($request->id);
    $post->published = 1;
    $post->save();
    return response()->json(['success' => true]);
  }

  public function hide (Request $request) {
    $post = Post::find($request->id);
    $post->published = 0;
    $post->save();
    return response()->json(['success' => true]);
  }

  public function delete (Request $request) {
    $post = Post::find($request->id);
    $post->delete();
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

    $request->validate([
      'title' => ['required', 'string', 'max:255']
    ]);

    $post = Post::find($id);
    $post->title = $request->title;
    $post->description = $request->description;
    $post->content = $request->content;
    $post->slug = \Str::slug($request->title);
    $post->youtube_link = $request->youtube_link;
    $post->published = $request->publish == "on" ? 1 : 0;

    if ( isset($request->new_thumbnail) ) {
      $thumbnail = ImageManagerStatic::make($request->file('new_thumbnail'))->encode('jpg', 35);
      $path = 'post_thumbnails/'. \Str::random(32) .'.jpg';
      Storage::put( $path, $thumbnail );
      $post->thumbnail = $path;
    }

    $post->save();

    return redirect("/admin/posts")->with('success','Post successfully updated!');

  }


  public function store( Request $request ) {

    $request->validate([
      'title' => ['required', 'string', 'max:255']
    ]);

    $thumbnail = ImageManagerStatic::make($request->file('thumbnail'))->encode('jpg', 35);
    $path = 'post_thumbnails/'. \Str::random(32) .'.jpg';
    Storage::put( $path, $thumbnail );

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
        'published' => $request->publish == "on" ? 1 : 0,
        'slug' => \Str::slug($request->title),
        'thumbnail' => $path,
        'youtube_link' => $request->youtube_link,
        'audio_file' => $audio_file_path
    ]);

    return redirect("/admin/posts")->with('success','Post successfully created!');

  }

}
