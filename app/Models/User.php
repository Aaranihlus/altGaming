<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'id',
        'username',
        'discriminator',
        'email',
        'avatar',
        'verified',
        'locale',
        'mfa_enabled',
        'refresh_token',
        'slug',
        'first_name',
        'surname',
        'address_line_1',
        'address_line_2',
        'town',
        'county',
        'postcode',
        'title_id',
        'badge_id',
        'twitch_channel',
        'youtube_channel'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'refresh_token',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'username' => 'string',
        'discriminator' => 'string',
        'email' => 'string',
        'avatar' => 'string',
        'verified' => 'boolean',
        'locale' => 'string',
        'mfa_enabled' => 'boolean',
        'refresh_token' => 'encrypted',
        'slug' => 'string'
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
      return $this->belongsToMany(Achievement::class);
    }

    public function orders() {
      return $this->hasMany(Order::class);
    }

    public function games() {
      return $this->belongsTo(Game::class);
    }

}
