<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Singer extends Model
{
    protected $fillable = ['name', 'slug', 'is_active', 'user_id', 'pix_key'];

    // ESSA É A RELAÇÃO QUE ESTÁ FALTANDO:
    public function songs()
    {
        // Se a sua tabela de músicas ainda usa 'musician_id', 
        // você precisa garantir que ela aceite o ID do Singer ou usar a FK correta.
        return $this->hasMany(Song::class, 'musician_id', 'id'); 
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}