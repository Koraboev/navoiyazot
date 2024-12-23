<?php

namespace App\View\Components;

use App\Models\Contact;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    public $contact;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->contact = Contact::where('lang', app()->getLocale())->firstOrFail();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header');
    }
}
