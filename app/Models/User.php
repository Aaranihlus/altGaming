<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable {

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'slug',
        'twitch_channel',
        'youtube_channel',
        'discord_id',
        'profile_picture',
        'title_id',
        'badge_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles() {
      return $this->belongsToMany(Role::class);
    }

    public function titles() {
      return $this->belongsToMany(Title::class);
    }

    public function badges() {
      return $this->belongsToMany(Badge::class);
    }




    public function badge() {
      return $this->belongsTo(Badge::class);
    }

    public function title() {
      return $this->belongsTo(Title::class);
    }

    public function achievements() {
      return $this->belongsToMany(achievements::class);
    }

    public function orders() {
      return $this->hasMany(Order::class);
    }



}
