<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model {
  use HasFactory;

  protected $fillable = [
    'name',
    'start_date',
    'end_date',
    'location',
    'description',
    'type',
    'slug',
    'alt_lan_number',
    'user_id',
    'thumbnail',
    'achievement_id',
    'active'
  ];

  public function user() {
    return $this->belongsTo(User::class);
  }

  public function tickets() {
    return $this->hasMany(Item::class);
  }

  public function orders() {
    return $this->hasManyThrough(ItemOrder::class, Item::class);
  }

  public function attendees() {
    return $this->hasMany(EventUser::class);
  }



}
