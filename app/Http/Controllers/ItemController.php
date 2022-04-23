<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\User;
use App\Models\ItemImage;

use App\Models\Option;
use App\Models\OptionGroup;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Intervention\Image\ImageManagerStatic;

class ItemController extends Controller {

  public function create () {
    return view('admin.create_item');
  }

  public function store( Request $request ) {

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
      $thumbnail = ImageManagerStatic::make($img)->encode('jpg', 35);
      $path = 'item_images/'. \Str::random(32) .'.jpg';
      Storage::put( $path, $thumbnail );
      $image = ItemImage::create([
          'item_id' => $item->id,
          'path' => $path
      ]);
    }

    for ($i = 0; $i < count($request->group); $i++) {

      $group = OptionGroup::create([
          'name' => $request->group[$i],
          'item_id' => $item->id
      ]);

      for ($k = 0; $k < count($request->option_name[$i]); $k++) {
        $option = Option::create([
            'option_group_id' => $group->id,
            'price_modifier' => $request->option_price[$i][$k],
            'name' => $request->option_name[$i][$k]
        ]);
      }

    }

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

    if ( isset( $request->file('image') ) ) {
      foreach ( $request->file('image') as $img ) {
        $path = $img->store('item_images');
        $image = ItemImage::create([
            'item_id' => $item->id,
            'path' => $path
        ]);
      }
    }

    return redirect("/admin/items");

  }




}
