<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class HasOrganiserRole {

  public function handle(Request $request, Closure $next) {

    if ( !Auth::user() ) {
      return redirect("/");
    }

    $user = Auth::user();

    if ( $user->roles->contains('name', 'Organiser') OR $user->roles->contains('name', 'Admin') ) {
      return $next($request);
    }

  }

}
