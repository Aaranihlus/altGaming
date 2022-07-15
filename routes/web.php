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
use App\Http\Controllers\OrderController;
use App\Http\Controllers\HeroBannerController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;

use Illuminate\Support\Facades\Redis;
use RestCord\DiscordClient;
use GuzzleHttp\Client;
use Carbon\Carbon;
use Intervention\Image\ImageManagerStatic;
use Barryvdh\DomPDF\Facade\Pdf;

require __DIR__.'/admin.php';
require __DIR__.'/auth.php';

// HOME
Route::get('/', function () {
  return view('home', [
    'posts' => Post::latest()->limit(9)->get(),
    'heroEnabled' => Redis::get('hero_active'),
    'heroItems' => HeroBannerController::get_hero_items()
  ]);
});

// ALT LAN
Route::get('/altlan', function () {
    $altlan = Event::where("alt_lan_number", "!=", null)->latest()->get()->last();
    return view('altlan', [
      'altlan' => $altlan
    ]);
});

// RSS FEED
Route::get('/feed', function () {
  $podcasts = Post::where('type', 'podcast')->latest()->get();
  return response()->view('feed', compact('podcasts'))->header('Content-Type', 'application/xml');
});

Route::get('/events', function () {
  return view('events', [
    'events' => Event::where('active', 1)->orderBy('id', 'DESC')->limit(6)->get()
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
      $postHtml .= View::make("components.content-template-alt")->with("post", $post)->render();
    }
  }

  return response()->json([
    'success' => true,
    'html' => $postHtml,
    'count' => $count
  ]);

});




Route::post('/event/register', [EventController::class, 'register'])->middleware('auth');



Route::post('/comment/store', [CommentController::class, 'store'])->middleware('auth');
Route::post('/comment/delete', [CommentController::class, 'delete'])->middleware('auth');


Route::post('/cart/add', [CartController::class, 'add'])->middleware('auth');
Route::post('/cart/remove', [CartController::class, 'remove'])->middleware('auth');
Route::get('/cart/clear', [CartController::class, 'clear'])->middleware('auth');
Route::get('/cart', [CartController::class, 'show'])->middleware('auth');







Route::post('/order/create', [OrderController::class, 'create'])->middleware('auth');
Route::post('/order/approve', [OrderController::class, 'approve'])->middleware('auth');
Route::get('/account/order/invoice/{order:id}', [OrderController::class, 'invoice'])->middleware('auth');
Route::get('/account/order/{order:id}', [OrderController::class, 'view'])->middleware('auth');









Route::get('/checkout', function (Request $request) {

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

  $response = $client->request('POST', 'https://api-m.sandbox.paypal.com/v1/identity/generate-token', [
    'headers' => [
      'Authorization' => 'Bearer ' . $access_token,
      'Accept-Language' => 'en_US',
      'Content-Type' => 'application/json'
    ]
  ]);

  $data = json_decode($response->getBody(), true);
  $client_token = $data['client_token'];

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

  return view('checkout', [
    'cart' => $cart,
    'cart_total' => $cart_total,
    'client_token' => $client_token,
    'client_id' => env('PAYPAL_CLIENT_ID')
  ]);

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
  $user->title_id = $request->title_id;
  $user->badge_id = $request->badge_id;
  $user->twitch_channel = $request->twitch_channel;
  $user->youtube_channel = $request->youtube_channel;
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

Route::post('/account/update', [UserController::class, 'update'])->middleware('auth');


Route::get('/discord/get_profile', function (Request $request) {

  $user = User::find('id', $request->user_id);

  if(!empty($user->id)){
    return response()->json([
      'success' => true,
      'user' => $user
    ]);
  }

  return response()->json([
    'success' => false,
    'message' => "User not found"
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


// Shop Pages
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
    'items' => Item::with('images')->latest()->get(),
    'filter' => $type
  ]);

});


Route::get('/shop/view/{item:slug}', function (Item $item) {
  return view('item', [
    'item' => $item
  ]);
});
