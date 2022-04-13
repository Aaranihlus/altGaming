<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemOrder extends Model {
    use HasFactory;

    protected $table = "item_order";

    protected $fillable = [
        'item_id',
        'order_id',
        'quantity',
        'unit_price'
    ];

    public function item() {
      return $this->belongsTo(Item::class);
    }

    public function order() {
      return $this->belongsTo(Order::class);
    }

    public function options() {
      return $this->hasMany(ItemOrderOption::class);
    }

}
