<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model {
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'description',
        'location',
        'start_date',
        'is_alt_lan',
        'slug'
    ];

}
