<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\ItemImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller {

  public function create () {
    return view('admin.create_item');
  }

  public function store( Request $request ) {

    dd($request);

    $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'price' => ['required', 'string', 'max:255']
    ]);

    $slug = \Str::slug($request->name);

    $item = Item::create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'slug' => $slug
    ]);

    // Image Array
    foreach ( $request->file('image') as $img ) {
      $path = $img->store('item_images');
      $image = ItemImage::create([
          'item_id' => $item->id,
          'path' => $path
      ]);
    }

    //Options Array



    //Variations Array




    return redirect("/admin/items");

  }

  public function edit ( Item $item ) {
    return view('admin.edit_item', [
      'item' => $item
    ]);
  }



  public function update ( $id, Request $request ) {

    $item = Item::where('id', $id)->get()->first();

    $item->name = $request->name;
    $slug = \Str::slug($request->name);
    $item->description = $request->description;
    $item->price = $request->price;
    $item->slug = $slug;
    $item->save();

    foreach ( $request->file('image') as $img ) {

      $path = $img->store('item_images');

      $image = ItemImage::create([
          'item_id' => $item->id,
          'path' => $path
      ]);

    }

    return redirect("/admin/items");

  }




}
