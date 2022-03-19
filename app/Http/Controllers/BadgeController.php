<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Badge;

class BadgeController extends Controller {

  public function create () {
    return view('admin.create_badge', [
      'badges' => Badge::all()
    ]);
  }

  public function store( Request $request ) {

    dd($request);

    $badge = Badge::create([
        'image' => $request->image('badge')->store('badges')
    ]);

    return redirect("/admin/titles_badges");

  }

}
