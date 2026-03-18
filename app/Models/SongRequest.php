<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SongRequest extends Model {
    protected $fillable = ["song_id", "customer_name", "amount", "status", "message"];
    public function song() { return $this->belongsTo(Song::class); }
}
