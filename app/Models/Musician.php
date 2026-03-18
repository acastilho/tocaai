<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Musician extends Model {
    protected $fillable = ["name", "slug", "bio", "is_active", "user_id"];
    
    public function user() { return $this->belongsTo(User::class); }
    public function songs() { return $this->hasMany(Song::class); }
}
