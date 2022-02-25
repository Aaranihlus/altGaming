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

    $path = $img->store('item_images');

    $achievement = Achievement::create([
        'name' => $request->name,
        'unlock_item' => $request->unlock_item,
        'image' => $path
    ]);

    return redirect("/admin/achievements");

  }

}
