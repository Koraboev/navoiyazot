<?php

namespace App\View\Components;

use App\Models\Employee;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Staff extends Component
{
    public $staffes;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->staffes = Employee::where('show_home', 1)->where('lang', app()->getLocale())->skip(0)->take(8)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.staff');
    }
}
