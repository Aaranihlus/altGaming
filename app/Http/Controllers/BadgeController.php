<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\Item;
use App\Models\Title;
use App\Models\Badge;
use App\Models\Role;

class BadgeController extends Controller {

  public function create () {
    return view('admin.create_badge', [
      'badges' => Badge::all()
    ]);
  }

  public function store( Request $request ) {

    $path = $request->image('badge_image')->store('badge_images');

    $badge = Badge::create([
        'image' => $path,
    ]);

    return redirect("/admin/badges");

  }

}
