<?php

namespace App\View\Components;

use App\Models\Home;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Gallery extends Component
{
    public $homeinfo;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->homeinfo = Home::where('lang', app()->getLocale())->firstOrFail();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.gallery');
    }
}
