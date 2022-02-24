<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;

class HasAdminRole {

  public function handle(Request $request, Closure $next) {

    if ( Auth::id() ) {

      $user = Auth::user();

      if(empty($user)) return redirect("/");

      foreach ( $user->roles as $role ) {
        if ( $role['name'] == "Admin" ) {
          return $next($request);
        }
      }

      return redirect("/");

    }

  }
}
