<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AltLanController extends Controller {

  public function create () {
    return view('admin.create_altlan');
  }

  public function store( Request $request ) {

    $request->validate([
        'name' => ['required', 'string', 'max:255']
    ]);

    $altlan = AltLan::create([
        'name' => $request->name,
    ]);


    $ticket = Item::create([
        'name' => "Normal Alt Lan Ticket",
        'price' => 99
    ]);

    $byoc_ticket = Item::create([
        'name' => "BYOC Alt Lan Ticket",
        'price' => 119
    ]);



    return redirect("/admin/altlan");

  }

}
