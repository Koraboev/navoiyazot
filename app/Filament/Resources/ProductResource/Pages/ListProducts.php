<?php

namespace App\Filament\Resources\ProductResource\Pages;

use App\Filament\Resources\ProductResource;
use App\Models\Product;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

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
                ->badge(Product::where('lang', $lang)->count())
                ->modifyQueryUsing(function ($query) use ($lang) {
                    return $query->where('lang', $lang);
                });
        }
 
        return $tabs;
    }
}
