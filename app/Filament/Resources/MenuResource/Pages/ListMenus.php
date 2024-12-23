<?php

namespace App\Filament\Resources\MenuResource\Pages;

use App\Filament\Resources\MenuResource;
use App\Models\Menu;
use Filament\Actions;
use Filament\Resources\Components\Tab; 
use Filament\Resources\Pages\ListRecords;

class ListMenus extends ListRecords
{
    protected static string $resource = MenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
    public function getTabs(): array
    {
        
        $tabs = ['all' => Tab::make('Все')->badge($this->getModel()::count())];

        $langs = ['ru', 'uz', 'en'];
 
        foreach ($langs as $lang) {
 
            $tabs[$lang] = Tab::make(trans($lang))
                ->badge(Menu::where('lang', $lang)->count())
                ->modifyQueryUsing(function ($query) use ($lang) {
                    return $query->where('lang', $lang);
                });
        }
 
        return $tabs;
    }
}
