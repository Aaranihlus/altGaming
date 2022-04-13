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

  public function update ( Request $request ) {
    $user = User::find(Auth::id());
    $user->first_name = $request->first_name;
    $user->surname = $request->surname;
    $user->address_line_1 = $request->address_line_1;
    $user->address_line_2 = $request->address_line_2;
    $user->county = $request->county;
    $user->town = $request->town;
    $user->postcode = $request->postcode;
    $user->save();
    return redirect("/account")->with('success', 'Account Details successfully updated!');
  }






}
