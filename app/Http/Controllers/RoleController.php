<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\Item;
use App\Models\Title;
use App\Models\Badge;
use App\Models\Role;

class RoleController extends Controller {

  public function create () {
    return view('admin.create_role', []);
  }

  public function store( Request $request ) {

    $request->validate([
        'name' => ['required', 'string', 'max:255']
    ]);

    $grant_title = 0;
    if($request->grant_title == "on")
      $grant_title = 1;

    $grant_badge = 0;
    if($request->grant_badge == "on")
      $grant_badge = 1;

    $unlock_item = 0;
    if($request->unlock_item == "on")
      $unlock_item = 1;

    $role = Role::create([
        'name' => $request->name,
        'grant_title' => $grant_title,
        'title_name' => $request->title_name,
        'grant_badge' => $grant_badge,
        'badge_image' => $request->badge_image,
        'unlock_item' => $unlock_item,
        'item_id' => $request->item_id
    ]);

    if ( $request->grant_title == "on" ) {
      $title = Title::create([
        'name' => $request->title,
        'role_id' => $role->id,
      ]);

      $role->title_id = $title->id;
      $role->save();
    }

    if ( $request->grant_badge == "on" ) {

      $path = $request->file('badge')->store('badge_images');

      $badge = Badge::create([
        'image' => $path,
        'role_id' => $role->id
      ]);

      $role->badge_id = $badge->id;
      $role->save();
    }

    if($request->unlock_item == "on") {
      $item = Item::where('id', $request->item_id)->get()->first();
      $item->role_id = $role->id;
      $item->save();
    }

    return redirect("/admin/roles");

  }

}
