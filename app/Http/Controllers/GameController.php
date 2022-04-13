<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameUser;
use App\Models\User;

use RestCord\DiscordClient;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller {

  public function create () {
    return view('admin.games', [
      'games' => Game::all()
    ]);
  }

  public function store( Request $request ) {

    $discord = new DiscordClient(['token' => env('DISCORD_BOT_TOKEN')]);

    $discordRole = $discord->guild->createGuildRole([
      'guild.id' => env('DISCORD_GUILD_ID'),
      'name' => $request->name
    ]);

    $game = Game::create([
      'name' => $request->name,
      'discord_id' => $discordRole->id
    ]);

    return response()->json([
      'success' => true
      'discord_id' => $discordRole->id
    ]);

  }

  public function delete( Request $request ) {

    $game = Game::where('discord_id', $request->id);
    $game->delete();

    $discord = new DiscordClient(['token' => env('DISCORD_BOT_TOKEN')]);

    $discord->guild->deleteGuildRole([
      'guild.id' => env('DISCORD_GUILD_ID'),
      'role.id' => $request->id
    ]);

    return response()->json(['success' => true]);

  }

}
