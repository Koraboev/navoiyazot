<?php

namespace App\View\Components;

use App\Models\Review as ModelsReview;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Review extends Component
{
    public $reviews;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->reviews = ModelsReview::where('show_home', 1)->where('lang', app()->getLocale())->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.review');
    }
}
