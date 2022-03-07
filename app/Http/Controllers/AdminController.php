<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Podcast;
use App\Models\Role;
use App\Models\Order;
use App\Models\Item;
use App\Models\Event;
use App\Models\AltLan;
use App\Models\Title;
use App\Models\Badge;
use App\Models\Achievement;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller {

  public function show () {
    return view('admin.home');
  }

  public function users () {
    return view('admin.users', [
      'users' => User::all(),
      'roles' => Role::all(),
      'achievements' => Achievement::all()
    ]);
  }

  public function posts () {
    return view('admin.posts', [
      'posts' => Post::with('user')->get()
    ]);
  }

  public function podcasts () {
    return view('admin.podcasts', [
      'podcasts' => Podcast::all()
    ]);
  }

  public function roles () {
    return view('admin.roles', [
      'roles' => Role::all()
    ]);
  }

  public function orders () {
    return view('admin.orders', [
      'orders' => Order::all()
    ]);
  }

  public function items () {
    return view('admin.items', [
      'items' => Item::where('visible', 1)->get(),
      'filter' => "active_only"
    ]);
  }

  public function all_items () {
    return view('admin.items', [
      'items' => Item::all(),
      'filter' => "all"
    ]);
  }

  public function altlan () {
    return view('admin.altlan', [
      'altlans' => AltLan::all()
    ]);
  }

  public function events () {
    return view('admin.events', [
      'events' => Event::all()
    ]);
  }

  public function badges () {
    return view('admin.badges', [
      'badges' => Badge::all()
    ]);
  }

  public function titles () {
    return view('admin.titles', [
      'titles' => Title::all()
    ]);
  }

  public function titles_badges () {
    return view('admin.titles_badges', [
      'titles' => Title::all(),
      'badges' => Badge::all()
    ]);
  }

  public function achievements () {
    return view('admin.achievements', [
      'achievements' => Achievement::all()
    ]);
  }

}
