<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TitleUser extends Model {
    use HasFactory;

    protected $table = "title_user";

    protected $fillable = [
        'user_id',
        'title_id'
    ];

    public function user() {
      return $this->hasOne(User::class);
    }

    public function title() {
      return $this->hasOne(Title::class);
    }

}
