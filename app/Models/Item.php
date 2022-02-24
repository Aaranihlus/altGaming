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
        'visible'
    ];

    public function user() {
      return $this->belongsTo(User::class);
    }

    public function images() {
      return $this->hasMany(ItemImage::class);
    }

}
