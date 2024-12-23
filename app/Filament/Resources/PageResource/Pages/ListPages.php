<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use App\Models\Page;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListPages extends ListRecords
{
    protected static string $resource = PageResource::class;

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
                ->badge(Page::where('lang', $lang)->count())
                ->modifyQueryUsing(function ($query) use ($lang) {
                    return $query->where('lang', $lang);
                });
        }
 
        return $tabs;
    }
}
