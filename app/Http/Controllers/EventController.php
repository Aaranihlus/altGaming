<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Models\Item;
use App\Models\Title;
use App\Models\Badge;
use App\Models\Role;
use App\Models\Event;
use App\Models\ItemImage;
use App\Models\Order;
use App\Models\ItemOrder;
use App\Models\Achievement;

use RestCord\DiscordClient;

class EventController extends Controller {

  public function create () {
    return view('admin.create_event', []);
  }

  public function tickets (Event $event) {
    return view('admin.tickets_sold', [
      'event' => $event
    ]);
  }

  public function edit (Event $event) {
    return view('admin.edit_event', [
      'event' => $event
    ]);
  }


  public function update( $id, Request $request ) {

    $event = Event::find($id);

    $event->title = $request->title;
    $event->start_date = $request->start_date;
    $event->end_date = $request->end_date;
    $event->location = $request->location;
    $event->description = $request->description;
    $event->slug = \Str::slug($request->title);

    if ( isset($request->new_thumbnail) ) {
      $path = $request->file('new_thumbnail')->store('event_thumbnails');
      $event->thumbnail = $path;
    }

    $event->save();

    return redirect("/admin/events");

  }





  public function store( Request $request ) {

    if ( $request->type == "altlan" ) {

      /*$altLans = Event::where('type', 'altlan')->get();
      $altLanCount = count($altLans);
      $altLanCount = $altLanCount + 1;

      $path = $request->file('thumbnail')->store('event_thumbnails');

      $achievement = Achievement::create([
          'name' => "altLAN #" . $altLanCount . " Attendee",
          'description' => "Awarded for attending altLAN #" . $altLanCount,
          'image' => 'item_images/placeholder-big.png',
          'item_id' => null
      ]);

      $event = Event::create([
          'title' => "altLAN #" . $altLanCount,
          'start_date' => $request->start_date,
          'location' => "Test",
          'description' => $request->description,
          'slug' => \Str::slug("altLAN #" . $altLanCount),
          'user_id' => Auth::id(),
          'type' => $request->type,
          'alt_lan_number' => $altLanCount,
          'thumbnail' => $path,
          'achievement_id' => $achievement->id
      ]);

      Item::where('is_alt_ticket', 1)->update(['visible' => 0]);*/

      // Create Discord Role
      $discord = new DiscordClient(['token' => env('DISCORD_BOT_TOKEN')]);

      $discordRole = $discord->guild->createGuildRole([
        'guild.id' => 607337690886701066,
        'name' => "altLAN #1 Attendee"
        //'name' => "altLAN #" . $altLanCount . " Attendee"
      ]);

      dd($discordRole);

      /*$standardTicket = Item::create([
          'name' => "altLAN #" . $altLanCount . " Standard Ticket",
          'price' => 99.00,
          'description' => "altLAN #" . $altLanCount . " Standard Ticket",
          'slug' => \Str::slug("altLAN #" . $altLanCount . " Standard Ticket"),
          'is_alt_ticket' => 1,
          'event_id' => $event->id,
          'visible' => 1,
          'achievement_id' => null,
          'discord_role_id' => $discordRole->id
      ]);

      $standardTicketImage = ItemImage::create([
          'item_id' => $standardTicket->id,
          'path' => 'item_images/standard-ticket.png'
      ]);

      $ByocTicket = Item::create([
          'name' => "altLAN #" . $altLanCount . " BYOC Ticket",
          'price' => 119.00,
          'description' => "altLAN #" . $altLanCount . " BYOC Ticket",
          'slug' => \Str::slug("altLAN #" . $altLanCount . " BYOC Ticket"),
          'is_alt_ticket' => 1,
          'event_id' => $event->id,
          'visible' => 1,
          'achievement_id' => null,
          'discord_role_id' => $discordRole->id
      ]);

      $ByocTicketImage = ItemImage::create([
          'item_id' => $ByocTicket->id,
          'path' => 'item_images/byoc-ticket.png'
      ]);*/

    }

    return redirect("/admin/events");
  }


}
