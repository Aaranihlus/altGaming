<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller {

  public function delete (Request $request) {
    $user = User::find($request->id);
    $user->delete();
    return response()->json(['success' => true]);
  }

  public function grant(Request $request) {
    RoleUser::create([
      'role_id' => $request->role_id,
      'user_id' => $request->id,
    ]);
    return response()->json(['success' => true]);
  }

  public function has_role ($user_id, $role_name) {
    $user = User::find($user_id);
    foreach($user->roles as $role){
      if($role->name = $role_name)
        return true;
    }
    return false;
  }

}
