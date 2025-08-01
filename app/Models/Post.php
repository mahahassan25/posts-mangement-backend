<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Post extends Model
{
      use HasFactory;
      protected $fillable = [
        'title',
        'body',
        'name',
        'author_id',
        'author_type',
    ];
     public function author()
    {
        return $this->morphTo();
    }
}
