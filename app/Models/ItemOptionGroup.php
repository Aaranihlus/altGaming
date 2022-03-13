<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemOptionGroup extends Model {
    use HasFactory;

    protected $fillable = [
      'item_id'
      'name'
    ];

    public function options() {
      return $this->hasMany(ItemOption::class);
    }

}
