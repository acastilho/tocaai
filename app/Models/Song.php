<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Song extends Model {
    protected $fillable = ["musician_id", "title", "artist_original"];
    public function musician() { return $this->belongsTo(Musician::class); }
}
