<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\Item;
use App\Models\Title;
use App\Models\Badge;
use App\Models\Role;

class TitleController extends Controller {

  public function create () {
    return view('admin.create_title', [
      'titles' => Title::all()
    ]);
  }

  public function store( Request $request ) {

    $title = Title::create([
        'name' => $request->title,
    ]);

    return redirect("/admin/titles");

  }




}
