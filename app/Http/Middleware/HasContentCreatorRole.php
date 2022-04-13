<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class HasContentCreatorRole {

  public function handle(Request $request, Closure $next) {

    if ( app()->isLocal() ) {
      return $next($request);
    }

    if ( !Auth::user() ) {
      return redirect("/");
    }

    $user = Auth::user();

    if ( $user->roles->contains('name', 'Content Creator') OR $user->roles->contains('name', 'Admin') ) {
      return $next($request);
    }

  }

}
