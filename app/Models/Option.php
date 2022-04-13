<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model {
    use HasFactory;

    protected $fillable = [
        'option_group_id',
        'price_modifier',
        'name'
    ];

    public function group() {
      return $this->belongsTo(OptionGroup::class, 'option_group_id');
    }

}
