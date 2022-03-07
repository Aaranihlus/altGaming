<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BadgeUser extends Model {
  use HasFactory;

  protected $table = "badge_user";

  protected $fillable = [
    'user_id',
    'badge_id'
  ];

  public function user() {
    return $this->hasOne(User::class);
  }

  public function badge() {
    return $this->hasOne(Badge::class);
  }

}
