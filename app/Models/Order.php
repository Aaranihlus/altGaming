<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'paypal_id',
        'total',
        'status'
    ];

    public function items() {
      return $this->hasMany(ItemOrder::class);
    }

    public function user() {
      return $this->belongsTo(User::class);
    }

}
