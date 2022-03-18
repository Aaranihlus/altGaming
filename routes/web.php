<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

use App\Models\Post;
use App\Models\User;
use App\Models\Order;
use App\Models\Item;
use App\Models\ItemOrder;
use App\Models\Event;
use App\Models\AchievementUser;
use App\Models\Achievement;

use App\Http\Controllers\CartController;
use App\Http\Controllers\CommentController;

use RestCord\DiscordClient;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic as Image;
use Barryvdh\DomPDF\Facade\Pdf;

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';

//General pages
Route::get('/', function () {
  return view('home', [
    'posts' => Post::latest()->limit(9)->get(),
    'highlighted_event' => Event::where('highlighted', 1)->get()->first()
  ]);
});

Route::get('/feed', function () {
  $podcasts = Post::where('type', 'podcast')->get();
  //echo Storage::size($podcasts[0]->audio_file);
  return response()->view('feed', compact('podcasts'))->header('Content-Type', 'application/xml');
});

Route::get('/events', function () {
  return view('events', [
    'events' => Event::all()
  ]);
});

Route::get('/blog', function () {
  return view('posts', [
    'posts' => Post::where('type', 'blog')->latest()->limit(9)->get(),
    'type' => "blog"
  ]);
});

Route::get('blog/{post:slug}', function (Post $post) {
  return view('post', [
    'post' => $post
  ]);
});

Route::get('/podcast', function () {
  return view('posts', [
    'posts' => Post::where('type', 'podcast')->latest()->limit(9)->get(),
    'type' => "podcast"
  ]);
});

Route::get('podcast/{post:slug}', function (Post $post) {
  return view('post', [
    'post' => $post
  ]);
});

Route::post('/loadposts', function (Request $request) {

  $offset = $request->offset;

  if(isset($request->type)){
    $posts = Post::with('user')->where('type', $request->type)->latest()->offset($offset)->limit(6)->get();
  } else {
    $posts = Post::with('user')->latest()->offset($offset)->limit(6)->get();
  }

  $count = count($posts);

  if ( !empty($posts) ) {
    $postHtml = "";
    foreach ( $posts as $post ) {
      $postHtml .= View::make("components.content-template-ajax")->with("post", $post)->render();
    }
  }

  return response()->json([
    'success' => true,
    'html' => $postHtml,
    'count' => $count
  ]);

});


Route::post('/comment/store', [CommentController::class, 'store'])->middleware('auth');
Route::post('/comment/delete', [CommentController::class, 'delete'])->middleware('auth');


Route::post('/cart/add', [CartController::class, 'add'])->middleware('auth');
Route::post('/cart/remove', [CartController::class, 'remove'])->middleware('auth');


Route::get('/cart', function (Request $request) {

  $client = new Client();

  $response = $client->request('POST', 'https://api-m.sandbox.paypal.com/v1/oauth2/token', [
    'headers' => [
      'Accept' => 'application/json',
      'Accept-Language' => 'en_US',
      'Content-Type' => 'application/x-www-form-urlencoded'
    ],
    'auth' => [
      env('PAYPAL_CLIENT_ID'),
      env('PAYPAL_SECRET'),
      'basic'
    ],
    'body' => 'grant_type=client_credentials'
  ]);

  $data = json_decode($response->getBody(), true);
  $access_token = $data['access_token'];

  $cart = [];
  $cart_total = 0.00;

  if($request->session()->has('cart')){
    foreach ( $request->session()->get('cart') as $c ) {
      if ( isset($c['id']) ) {
        $item = Item::with('images')->where('id', $c['id'])->get()->first();
        $item->quantity = $c['quantity'];
        $cart[] = $item;
        $cart_total += $item['price'] * $c['quantity'];
      }
    }
  }

  return view('cart', [
    'cart' => $cart,
    'cart_total' => $cart_total,
    'access_token' => $access_token,
    'client_id' => env('PAYPAL_CLIENT_ID')
  ]);

});

Route::get('/checkout', function () {

  $cart = [];
  $cart_total = 0.00;

  if(session()->has('cart')){
    foreach ( session()->get('cart') as $c ) {
      if ( isset($c['id']) ) {
        $item = Item::where('id', $c['id'])->get()->first();
        $item->quantity = $c['quantity'];
        $cart[] = $item;
        $cart_total += $item['price'] * $c['quantity'];
      }
    }
  }

  /*$stripe = new \Stripe\StripeClient('sk_test_51KDtUjBV7pNfWMJyt7HVoEKZEigukYjvzy77DVmJIyyqSUHsQ9sqag616thKxNj9Vp9as7pT1ZbrC4XxVA9rNqx100gtI5qSJz');

  $intent = $stripe->paymentIntents->create([
    'amount' => 9999,
    'currency' => 'gbp',
    'automatic_payment_methods' => ['enabled' => true]
  ]);*/

  return view('checkout', [
    //'client_secret' => $intent->client_secret
    'cart_total' => $cart_total
  ]);

});



Route::post('/order/create', function(Request $request) {

  if ( !isset($request->id) OR empty($request->id) OR empty(Auth::id()) ) {
    return redirect("/");
  }

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

    $item = Item::find($item['id']);

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
          'guild.id' => 607337690886701066,
          'user.id' => intval($user->id),
          'role.id' => intval($item->discord_role_id)
        ]);
      }

    }

  }

  $request->session()->forget('cart');

  //$pdf = PDF::loadView('pdf.invoice', $data);
  //return $pdf->download('invoice.pdf');





  return response()->json(['success' => true]);

});





Route::get('/checkout/success/{paypal_id}', function ( $paypal_id ) {

  $order = DB::table('orders')->where('paypal_id', $paypal_id)->first();

  if( empty(Auth::id()) OR $order->user_id != Auth::id() ) {
    return redirect("/");
  }

  return view('order-confirmation', [
    'order' => $order
  ]);

});








// Profile pages
Route::get('/profile/edit', function () {
  return view('edit-profile', [
    'user' => User::with('roles', 'titles', 'badges')->where('id', Auth::id())->get()->first()
  ]);
});

Route::post('/profile/update', function (Request $request) {

  $user = User::find(Auth::id());

  if(isset($request->profile_picture)){
    //$image = Image::make($request->profile_picture->getRealPath());
    //$image_resize->resize(300, 300);
    $path = $request->file('profile_picture')->store('profile_pictures');
    $user->profile_picture = $path;
  }

  $user->profile_visible = 0;
  if($request->profile_visible == "on"){
    $user->profile_visible = 1;
  }

  $user->title_id = $request->title_id;
  $user->badge_id = $request->badge_id;
  $user->twitch_channel = $request->twitch_channel;
  $user->youtube_channel = $request->youtube_channel;
  $user->discord_id = $request->discord_id;

  $user->save();
  return redirect("/profile/edit");
});


Route::get('/account', function () {

  if ( !Auth::id() ) {
    return redirect("/");
  }

  return view('account', [
    'user' => User::with('orders')->where('id', Auth::id())->get()->first()
  ]);

});

Route::get('/account/order/{order:paypal_id}', function (Order $order) {

  if ( !Auth::id() OR Auth::id() != $order->user_id ) {
    return redirect("/");
  }

  return view('order', [
    'order' => $order
  ]);

});





Route::get('/discord/get_profile', function (Request $request) {

  $user = User::where('id', $request->user_id);

  return response()->json([
    'success' => true,
    'user' => $user
  ]);

});





Route::get('/profile/{user:slug}', function (User $user) {

  if ( !$user->profile_visible && Auth::id() != $user->id ) {
    return redirect("/");
  }

  return view('profile', [
    'user' => User::with('roles', 'badge', 'title')->where('slug', $user->slug)->get()->first()
  ]);
});


Route::get('/shop/{type}', function ($type) {

  if ( $type == "tickets" ) {
    return view('shop', [
      'items' => Item::with('images')->where('is_alt_ticket', 1)->get(),
      'filter' => $type
    ]);
  }

  if ( $type == "merch" ) {
    return view('shop', [
      'items' => Item::with('images')->where('is_alt_ticket', 0)->get(),
      'filter' => $type
    ]);
  }

  return view('shop', [
    'items' => Item::with('images')->get(),
    'filter' => $type
  ]);

});


Route::get('/shop/view/{item:slug}', function (Item $item) {
  return view('item', [
    'item' => $item
  ]);
});

// Shop Pages


// Altlan pages
Route::get('/altlan', function () {
    return view('altlan');
});
