<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use App\Models\Comment;

class CommentController extends Controller {

  public function store( Request $request ) {

    $comment = Comment::create([
      'user_id' => Auth::id(),
      'post_id' => $request->post_id,
      'comment' => $request->comment
    ]);

    return response()->json([
      'success' => true,
      'comment' => $comment
    ]);

  }

  public function delete (Request $request) {
    $comment = Comment::find($request->comment_id);
    $comment->delete();
    return response()->json(['success' => true]);
  }

}
