<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model {
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'content',
        'user_id',
        'published',
        'slug',
        'thumbnail',
        'spotify_link',
        'youtube_link',
        'audio_file',
        'apple_link',
        'type'
    ];

    public function user() {
      return $this->belongsTo(User::class);
    }

}
