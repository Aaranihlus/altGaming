<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\Item;
use App\Models\User;

class CartController extends Controller {

  public function add (Request $request) {

    $cart_item_qty = 0;

    if ($request->session()->has('cart')) {
      $cart = $request->session()->get('cart');
    }

    if ( isset($cart) ) {
      foreach ( $cart as $c ) {
        if ( $c['id'] == $request->id ) {
          $c['quantity'] = $c['quantity'] + 1;
          $cart_item_qty += 1;
        } else {
          $item = [];
          $item['id'] = $request->id;

          if(isset($request->quantity)){
            $item['quantity'] = $request->quantity;
            $cart_item_qty += $request->quantity;
          }

          $request->session()->push('cart', $item);
        }
      }
    } else {
      $item = [];
      $item['id'] = $request->id;
      $item['quantity'] = 1;
      $cart_item_qty += 1;
      $request->session()->push('cart', $item);
    }

    session(['cart_item_qty' => $cart_item_qty]);

    if ( $cart_item_qty == 0 ) {
      $request->session()->forget('cart_item_qty');
    }

    $item = Item::where('id', $request->id)->get()->first();

    return response()->json([
      'success' => true,
      'item_name' => $item['name']
    ]);

  }

  public function remove (Request $request) {

    $request->session()->pull('cart', $request->index);

    $cart_item_qty = 0;

    $cart = $request->session()->get('cart');

    if(!empty($cart)){
      foreach ( $cart as $c ) {
        $cart_item_qty += $c['quantity'];
      }
    }

    $item = Item::where('id', $request->id)->get()->first();

    session(['cart_item_qty' => $cart_item_qty]);

    if ( $cart_item_qty == 0 ) {
      $request->session()->forget('cart_item_qty');
    }

    return response()->json([
      'success' => true,
      'item_name' => $item['name']
    ]);

  }

}
