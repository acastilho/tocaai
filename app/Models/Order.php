<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'musician_id',
        'song_id',
        'client_name',
        'amount',
        'status'
    ];

    public function musician()
    {
        return $this->belongsTo(Musician::class);
    }

    public function song()
    {
        return $this->belongsTo(Song::class);
    }
}
