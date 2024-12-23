<?php

namespace App\View\Components;

use App\Models\Menu as ModelsMenu;
use App\Models\Page as ModelsPage;
use App\Models\ProductCategory;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class Menu extends Component
{
    public $menu;
    public $page = [];
    public $categories;
    /**
     * Create a new component instance.
     */

    public function __construct()
    {
        $this->menu = ModelsMenu::where('lang', app()->getLocale())->get();
        foreach($this->menu as $item)
        {
            $item->page_id==null?$this->page[$item->id] = null:$this->page[$item->id] = ModelsPage::find($item->page_id)->slug;
        }

        $this->categories = ProductCategory::where('lang', app()->getLocale())->get();
       
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu');
    }
}
