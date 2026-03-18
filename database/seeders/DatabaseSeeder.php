<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Musician;
use App\Models\Song;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        $m = Musician::create([
            "name" => "João do Violão",
            "slug" => "joao-do-violao",
            "bio" => "O melhor do MPB e Rock Nacional"
        ]);

        Song::create(["musician_id" => $m->id, "title" => "Evidências", "artist_original" => "Chitãozinho & Xororó"]);
        Song::create(["musician_id" => $m->id, "title" => "Tempo Perdido", "artist_original" => "Legião Urbana"]);
    }
}
