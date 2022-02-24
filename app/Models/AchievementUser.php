<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AchievementUser extends Model {
    use HasFactory;

    protected $table = "achievement_user";

    protected $fillable = [
        'user_id',
        'achievement_id'
    ];

    public function user() {
      return $this->hasOne(User::class);
    }

    public function achievement() {
      return $this->hasOne(Achievement::class);
    }

}
