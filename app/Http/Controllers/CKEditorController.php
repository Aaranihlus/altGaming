<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class CKEditorController extends Controller {

  public function store(Request $request) {
    $thumbnail = $request->file('upload');
    $path = $request->file('upload')->store('blog_post_images');
    $url = asset("storage/" . $path);
    return response()->json(['uploaded'=> 1, 'url' => $url]);
  }

}
