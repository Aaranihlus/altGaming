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

    if(empty(Auth::id())){
      return redirect("/");
    }

    $user = User::find(Auth::id());

    $order = Order::create([
      'user_id' => Auth::id(),
      'total' => $request->total,
      'status' => "Order Created"
    ]);

    $order->id = \Str::random(20);
    $order->save();

    foreach ( session()->get('cart') as $item ) {

      $itemOrder = ItemOrder::create([
        'order_id' => $order->id,
        'item_id' => $item['id'],
        'quantity' => $item['quantity'],
        'unit_price' => $item['unit_price']
      ]);

      foreach($item['options'] as $option){
        ItemOrderOption::create([
          'item_order_id' => $itemOrder->id,
          'option_id' => $option
        ]);
      }

    }

    return response()->json([
      'success' => true,
      'order_id' => $order->id
    ]);

  }

  public function approve (Request $request) {

    $order = Order::find($request->order_id);
    $order->status = "Payment Received";
    $order->paypal_id = $request->paypal_id;
    $order->save();

    if ( !empty($item) ) {

      if ( $item->event->achievement_id != null AND !$user->achievements->contains('id', $item->event->achievement_id) ) {
        $achievement = AchievementUser::create([
          'user_id' => Auth::id(),
          'achievement_id' => $item->event->achievement_id
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

    }

    $request->session()->forget('cart');

  }


  public function invoice (Order $order) {

    /*if ( !Auth::id() OR Auth::id() != $order->user_id ) {
      return redirect("/");
    }*/

    $data = [];
    $data['paypal_id'] = $order->paypal_id;
    $data['order_items'] = [];
    foreach ( $order->items as $k => $v ) {
      $data['order_items'][] = [
        'quantity' => $v->quantity,
        'price' => $v->item->price,
        'name' => $v->item->name
      ];
    }

    $data['order_total'] = $order->amount;

    $pdf = PDF::loadView( 'invoice', $data );
    return $pdf->stream( 'invoice_'.$order->paypal_id.'.pdf' );
  }

}
