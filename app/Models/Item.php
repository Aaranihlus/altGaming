<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model {
  use HasFactory;

  protected $fillable = [
    'name',
    'description',
    'price',
    'slug',
    'is_alt_ticket',
    'visible',
    'event_id',
    'achievement_id',
    'discord_role_id',
    'type'
  ];

  public function user() {
    return $this->belongsTo(User::class);
  }

  public function images() {
    return $this->hasMany(ItemImage::class);
  }

  public function event() {
    return $this->belongsTo(Event::class);
  }

  public function orders() {
    return $this->hasMany(ItemOrder::class);
  }

  public function groups() {
    return $this->hasMany(OptionGroup::class);
  }

  public function options() {
    return $this->hasManyThrough(Option::class, OptionGroup::class);
  }

}
