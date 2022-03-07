<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\ItemImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AchievementController extends Controller {

  public function create () {
    return view('admin.create_achievement',[
      'items' => Item::all()
    ]);
  }

  public function store( Request $request ) {

    $request->validate([
        'name' => ['required', 'string', 'max:255']
    ]);

    $path = $request->file('image')->store('achievement_images');

    $achievement = Achievement::create([
        'name' => $request->name,
        'description' => $request->description,
        'item_id' => !empty($request->item_id) ? $request->item_id : null,
        'image' => $path
    ]);

    if ( !empty($request->item_id) ) {
      $item = Item::find($request->item_id);
      $item->achievement_id = $achievement->id;
      $item->save();
    }

    return redirect("/admin/achievements");

  }

}
