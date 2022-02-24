<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\Item;
use App\Models\Title;
use App\Models\Badge;
use App\Models\Role;
use App\Models\Event;
use App\Models\ItemImage;

class EventController extends Controller {

  public function create () {
    return view('admin.create_event', []);
  }

  public function store( Request $request ) {

    $request->validate([
        'title' => ['required', 'string', 'max:255']
    ]);

    $slug = \Str::slug($request->title);

    $event = Event::create([
        'title' => $request->title,
        'start_date' => $request->start_date,
        'location' => $request->location,
        'description' => $request->description,
        'slug' => $slug,
        'user_id' => Auth::id(),
        'is_alt_lan' => $request->type == "alt lan" ? 1 : 0
    ]);

    if($request->type == "alt lan"){

      $item1 = Item::create([
          'name' => "altLAN Ticket",
          'price' => 99.00,
          'description' => "altLAN ticket",
          'slug' => \Str::slug("altLAN Ticket"),
          'is_alt_ticket' => 1,
          'visible' => 1
      ]);

      $itemimage1 = ItemImage::create([
          'item_id' => $item1->id,
          'path' => 'item_images/placeholder-big.png'
      ]);

      $item2 = Item::create([
          'name' => "altLAN BYOC Ticket",
          'price' => 119.00,
          'description' => "altLAN BYOC ticket",
          'slug' => \Str::slug("altLAN BYOC Ticket"),
          'is_alt_ticket' => 1,
          'visible' => 1
      ]);

      $itemimage2 = ItemImage::create([
          'item_id' => $item2->id,
          'path' => 'item_images/placeholder-big.png'
      ]);

    }

    return redirect("/admin/events");

  }

}
