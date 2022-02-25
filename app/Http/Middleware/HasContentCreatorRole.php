<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class HasContentCreatorRole {

  public function handle(Request $request, Closure $next) {

    if ( Auth::id() ) {

      $user = Auth::user();

      if(empty($user)) return redirect("/");

      foreach ( $user->roles as $role ) {
        if ( $role['name'] == "Content Creator" OR $role['name'] == "Admin" ) {
          return $next($request);
        }
      }

      return redirect("/");

    }

  }
}
