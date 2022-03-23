<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Post;
use App\Models\Event;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

class HeroBannerController extends Controller {

  public function items_by_type( Request $request ) {

    if ( $request->type == "event" )
      $items = Event::all();

    if ( $request->type == "post" )
      $items = Post::all();

    if ( $request->type == "item" )
      $items = Item::all();

    return response()->json([
      'success' => 1,
      'items' => $items
    ]);

  }

  public function enable ( Request $request ) {
    Redis::set('hero_active', true);
  }

  public function disable ( Request $request ) {
    Redis::set('hero_active', false);
  }

  public function store ( Request $request ) {

    //dd($request);

    for ($i = 1; $i <= count($request->hero_id); $i++) {
      if($request->hero_id[$i] == 0){
        \DB::insert('INSERT INTO hero_banner (`order`, object_type, object_id) VALUES (?, ?, ?)', [
          $request->order[$i],
          $request->type[$i],
          $request->id[$i]
        ]);
      } else {
        \DB::statement('UPDATE hero_banner SET object_type = ?, object_id = ?, order = ? WHERE id = ?', [
          $request->type[$i],
          $request->id[$i],
          $request->order[$i],
          $request->hero_id[$i]
        ]);
      }
    }

    return redirect("/admin/hero");

  }

}
