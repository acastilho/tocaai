<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    public $musician;

    public function __construct($musician = null)
    {
        $this->musician = $musician;
    }

    public function render(): View
    {
        return view("layouts.app");
    }
}
