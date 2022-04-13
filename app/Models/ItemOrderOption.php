<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemOrderOption extends Model {
    use HasFactory;

    protected $fillable = [
        'item_order_id',
        'option_id'
    ];

    public function item() {
      return $this->belongsTo(ItemOrder::class);
    }

    public function option() {
      return $this->belongsTo(Option::class);
    }

}
