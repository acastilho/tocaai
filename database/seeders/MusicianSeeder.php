<?php

namespace Database\Seeders;

use App\Models\Musician;
use App\Models\Song;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MusicianSeeder extends Seeder
{
    public function run(): void
    {
        $musician = Musician::create([
            'name' => 'João do Violão',
            'slug' => 'joao-do-violao',
            'pix_key' => 'suachave@pix.com',
            'bio' => 'O melhor do MPB e Rock Nacional',
            'is_active' => true,
        ]);

        $songs = [
            ['title' => 'Evidências', 'artist_original' => 'Chitãozinho & Xororó', 'category' => 'Sertanejo'],
            ['title' => 'Tempo Perdido', 'artist_original' => 'Legião Urbana', 'category' => 'Rock Nacional'],
            ['title' => 'Garota de Ipanema', 'artist_original' => 'Tom Jobim', 'category' => 'MPB'],
        ];

        foreach ($songs as $song) {
            Song::create(array_merge($song, ['musician_id' => $musician->id]));
        }
    }
}
