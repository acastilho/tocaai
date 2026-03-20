<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Musician extends Model
{
    use HasFactory;

  protected $fillable = ['name', 'slug', 'is_active', 'user_id', 'pix_key'];

    public function songs()
    {
        return $this->hasMany(Song::class);
    }
}
