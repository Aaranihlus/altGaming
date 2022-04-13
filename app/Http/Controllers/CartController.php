<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\Item;
use App\Models\User;
use App\Models\Option;

class CartController extends Controller {

  public static function info () {

    $data['cartQuantity'] = 0;
    $data['cartTotal'] = 0;
    $data['cartItems'] = [];

    if (session()->has('cart')) {
      foreach( session()->get('cart') as $cart ) {
        $data['cartQuantity'] += $cart['quantity'];
        $data['cartTotal'] += $cart['unit_price'];
        $item = Item::with('images')->where('id', $cart['id'])->get()->first();
        $item['options'] = Option::with('group')->whereIn('id', $cart['options'])->get();
        $item['unit_price'] = $cart['unit_price'];
        $item['quantity'] = $cart['quantity'];
        $data['cartItems'][] = $item;
      }
    }

    session([
      'cartItems' => $data['cartItems'],
      'cartQuantity' => $data['cartQuantity'],
      'cartTotal' => $data['cartTotal']
    ]);

    return $data;
  }

  public function clear (Request $request) {
    session()->forget('cart');
    return redirect('cart');
  }

  public function show ( Request $request ) {
    $info = CartController::info();
    return view('cart', [
      'cart_items' => $info['cartItems'] ?? [],
      'cart_total' => $info['cartTotal'] ?? "",
      'cart_quantity' => $info['cartQuantity'] ?? ""
    ]);
  }

  public function add (Request $request) {

    $itemFound = false;

    if($request->session()->has('cart')){
      foreach( session()->get('cart') as $k => $v ) {
        if ( $request->id == $v['id'] && $v['options'] == $request->options ) {
          $itemFound = true;
        }
      }
    }

    if(!$itemFound OR !$request->session()->has('cart')){
      $request->session()->push('cart', [
        'id' => $request->id,
        'quantity' => $request->quantity,
        'options' => $request->options,
        'unit_price' => intval($request->unit_price),
        'name' => $request->name
      ]);
    }

    $info = self::info();

    return response()->json([
      'success' => true,
      'cart' => session()->get('cart'),
      'cart_total' => $info['cartTotal'],
      'cart_quantity' => $info['cartQuantity']
    ]);

  }

  public function remove (Request $request) {

    $cart = session()->get('cart');
    $itemName = $cart[$request->index]['name'];
    unset($cart[$request->index]);
    $cart = array_values($cart);
    session(['cart' => $cart]);

    $info = self::info();
    return response()->json([
      'success' => true,
      'cart_total' => $info['cartTotal'],
      'cart_quantity' => $info['cartQuantity'],
      'item_name' => $itemName
    ]);
  }

}
