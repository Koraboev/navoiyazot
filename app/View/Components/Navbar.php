<?php

namespace App\View\Components;

use App\Models\Contact;
use App\Models\Menu;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navbar extends Component
{
    public $menu;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->menu = Menu::where('lang', app()->getLocale())->first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-bar');
    }
}
