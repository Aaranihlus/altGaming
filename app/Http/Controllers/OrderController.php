<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\Item;
use App\Models\Title;
use App\Models\Badge;
use App\Models\Role;
use App\Models\User;

use App\Models\Order;
use App\Models\ItemOrder;
use App\Models\ItemOrderOption;
use App\Models\EventUser;

use App\Http\Controllers\CartController;

use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller {

  public function view (Order $order) {

    return view('order', [
      'order' => $order
    ]);

    if ( !Auth::id() OR Auth::id() != $order->user_id ) {
      return redirect("/");
    }

    return view('order', [
      'order' => $order
    ]);
  }

  public function create (Request $request) {

    if ( empty(Auth::id()) ) {
      return redirect("/");
    }

    $user = User::find(Auth::id());
    $cartInfo = CartController::info();

    $newOrderID = "";
    for ( $i = 0; $i < 19; $i++ ) {
      $min = ($i == 0) ? 1:0;
      $newOrderID .= mt_rand($min,9);
    }

    $order = Order::create([
      'id' => $newOrderID,
      'user_id' => Auth::id(),
      'total' => $cartInfo['cartTotal'],
      'status' => "Order Created"
    ]);

    foreach ( $cartInfo['cartItems'] as $item ) {

      $itemOrder = ItemOrder::create([
        'order_id' => $newOrderID,
        'item_id' => $item['id'],
        'quantity' => $item['quantity'],
        'unit_price' => $item['unit_price']
      ]);

      foreach($item['options'] as $option){
        ItemOrderOption::create([
          'item_order_id' => $itemOrder->id,
          'option_id' => $option->id
        ]);
      }

    }

    return response()->json([
      'success' => true,
      'order_id' => $newOrderID
    ]);

  }

  public function approve (Request $request) {

    $order = Order::find($request->order_id);
    $order->status = "Payment Received";
    $order->paypal_id = $request->paypal_id;
    $order->save();

    /*foreach ( !empty($order->items as $item) ) {

      if(isset($item->event)){

        if ( $item->event->achievement_id != null AND !$user->achievements->contains('id', $item->event->achievement_id) ) {
          $achievement = AchievementUser::create([
            'user_id' => Auth::id(),
            'achievement_id' => $item->event->achievement_id
          ]);
        }

        $eventUser = EventUser::create([
          'user_id' => Auth::id(),
          'event_id' => $item->event->id
        ]);

      }

      if ( $item->discord_role_id != null ) {
        $discord = new DiscordClient(['token' => env('DISCORD_BOT_TOKEN')]);
        $discord->guild->addGuildMemberRole([
          'guild.id' => env('DISCORD_GUILD_ID'),
          'user.id' => intval($user->id),
          'role.id' => intval($item->discord_role_id)
        ]);
      }

    }*/

    session()->forget('cart');

  }


  public function invoice (Order $order) {

    if ( !Auth::id() OR Auth::id() != $order->user_id ) {
      return redirect("/");
    }

    $data = [];

    $data['id'] = $order->id;
    $data['user'] = $order->user->toArray();
    $data['paypal_id'] = $order->paypal_id;
    $data['order_total'] = $order->total;
    $data['order_date'] = $order->created_at;
    $data['order_items'] = [];

    foreach ( $order->items as $k => $v ) {

      $data['order_items'][$k] = [
        'quantity' => $v->quantity,
        'price' => $v->unit_price,
        'name' => $v->item->name,
        'options' => []
      ];

      foreach ( $v->options as $option ) {
        $data['order_items'][$k]['options'][] = [
          'name' => $option->option->name,
          'group' => $option->option->group->name
        ];
      }

    }

    //dd($data);
    PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
    return PDF::loadView('invoice', $data)->stream('invoice_'.$order->id.'.pdf');
  }

}
