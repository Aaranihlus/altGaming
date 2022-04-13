<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Post;
use App\Models\Event;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;

use Intervention\Image\ImageManagerStatic;

class HeroBannerController extends Controller {

  public static function get_hero_items(){

    $heroItems = [];

    foreach ( \DB::select('select * from hero_banner') as $hero ) {
      if ( $hero->object_type == "event" OR $hero->object_type == "altlan" ) {
        $item = Event::where('id', $hero->object_id)->get()->first();
      } elseif( $hero->object_type == "blog" OR $hero->object_type == "podcast" ) {
        $item = Post::where('id', $hero->object_id)->get()->first();
      } elseif( $hero->object_type == "item" ) {
        $item = Item::with('images')->where('id', $hero->object_id)->get()->first();
      }

      $item['hero_id'] = $hero->id;

      $item['order'] = $hero->order;

      if ( !empty($hero->custom_image)){
        $item['custom_image'] = $hero->custom_image;
      }

      if ( !empty($hero->custom_text)){
        $item['custom_text'] = $hero->custom_text;
      }

      $heroItems[] = $item;
    }
    return $heroItems;
  }

  public function items_by_type( Request $request ) {

    if ( $request->type == "event" )
      $items = Event::where('type', 'other')->get();

    if ( $request->type == "altlan" )
      $items = Event::where('type', 'altlan')->get();

    if ( $request->type == "item" )
      $items = Item::all();

    if ( $request->type == "podcast" )
      $items = Post::where('type', "podcast")->get();

    if ( $request->type == "blog" )
      $items = Post::where('type', "blog")->get();

    return response()->json([
      'success' => 1,
      'items' => $items
    ]);

  }

  public function delete ( Request $request ) {
    \DB::table('hero_banner')->where( 'id', $request->id )->delete();
    return response()->json(['success' => true]);
  }

  public function enable ( Request $request ) {
    Redis::set('hero_active', true);
  }

  public function disable ( Request $request ) {
    Redis::set('hero_active', false);
  }

  public function update_order ( Request $request ) {
    dd($request);
  }

  public function store ( Request $request ) {

    $totalItems = count(\DB::select('select * from hero_banner'));
    $order = $totalItems += 1;

    if ( !empty( $request->file('custom_image') ) ) {
      $thumbnail = ImageManagerStatic::make($request->file('custom_image'))->encode('jpg', 35);
      $path = 'hero_banner_images/'. \Str::random(32) .'.jpg';
      Storage::put( $path, $thumbnail );
    }

    \DB::insert('INSERT INTO hero_banner (object_type, object_id, custom_text, custom_image, `order`) VALUES (?, ?, ?, ?, ?)', [
      $request->item_type,
      $request->item_id,
      $request->custom_text,
      $path ?? "",
      $order
    ]);

    return redirect("/admin/hero");

  }

}
