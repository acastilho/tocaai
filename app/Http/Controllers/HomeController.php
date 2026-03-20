<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Renderiza a Landing Page principal.
     */
    public function index(): View
    {
        return view('welcome');
    }

    /**
     * Renderiza a página explicativa do fluxo do sistema.
     */
    public function howItWorks(): View
    {
        return view('how-it-works');
    }
}