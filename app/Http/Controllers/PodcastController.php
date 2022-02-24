<?php

namespace App\Http\Controllers;

use App\Models\Podcast;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PodcastController extends Controller {

  public function publish (Request $request) {
    $podcast = Podcast::find($request->id);
    $podcast->published = 1;
    $podcast->save();

  }

  public function delete (Request $request) {
    $podcast = Podcast::find($request->id);
    $podcast->delete();
  }

  public function hide (Request $request) {
    $podcast = Podcast::find($request->id);
    $podcast->published = 0;
    $podcast->save();
  }

  public function create () {
    return view('admin.create_podcast');
  }

  public function store( Request $request ) {

    $slug = \Str::slug($request->title);

    $thumbnail = $request->file('thumbnail');
    $path = $request->file('thumbnail')->store('podcast_thumbnails');

    $audio_file = $request->file('audio_file');
    $audio_path = $request->file('audio_file')->store('podcast_audio_files');

    $request->validate([
        'title' => ['required', 'string', 'max:255'],
        'description' => ['required', 'string', 'max:255'],
        'content' => ['required', 'string'],
    ]);

    $podcast = Podcast::create([
        'title' => $request->title,
        'description' => $request->description,
        'spotify_link' => $request->spotify_link,
        'apple_link' => $request->apple_link,
        'user_id' => Auth::id(),
        'published' => false,
        'slug' => $slug,
        'thumbnail' => $path,
        'audio_file' => $audio_path
    ]);

    return redirect("/admin/podcasts");

  }

}
