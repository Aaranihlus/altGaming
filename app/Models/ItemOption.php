<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemOption extends Model {
    use HasFactory;

    protected $fillable = [
        'item_option_group_id',
        'price',
        'name'
    ];

    public function group() {
      return $this->belongsTo(ItemOptionGroup::class);
    }

}
