<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id',
        'paypal_id',
        'amount'
    ];

    public function items() {
      return $this->hasMany(ItemOrder::class);
    }

}
