<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\Item;
use App\Models\Title;
use App\Models\Badge;
use App\Models\Role;

use App\Models\Order;
use App\Models\ItemOrder;

class OrderController extends Controller {

  public function view (Order $order) {
    return view('order', [
      'order' => $order
    ]);
  }

  public function create (Request $request) {

    $user = User::find(Auth::id());

    $order = Order::create([
      'user_id' => Auth::id(),
      'paypal_id' => $request->id,
      'amount' => $request->amount
    ]);

    foreach ( session()->get('cart') as $item ) {
      ItemOrder::create([
        'order_id' => $order->id,
        'item_id' => $item['id'],
        'quantity' => $item['quantity']
      ]);
    }

  }

  public function approve (Request $request) {

  }


}
