<?php

namespace App\Http\Controllers;

use App\Models\Musician;
use Illuminate\Http\Request;

class MusicianController extends Controller
{
    public function show($slug)
    {
        $musician = Musician::where('slug', $slug)
            ->where('is_active', true)
            ->with(['songs' => function($query) {
                $query->where('available', true);
            }])
            ->firstOrFail();

        return view('musician.show', compact('musician'));
    }
}
