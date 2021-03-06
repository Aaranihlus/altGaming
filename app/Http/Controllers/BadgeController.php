<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class BadgeController extends Controller {

  public function create () {
    return view('admin.create_badge', [
      'badges' => Badge::all()
    ]);
  }

  public function store( Request $request ) {

    $badge = Badge::create([
        'image' => $request->file('badge')->store('badges')
    ]);

    return redirect("/admin/titles_badges");

  }

}
