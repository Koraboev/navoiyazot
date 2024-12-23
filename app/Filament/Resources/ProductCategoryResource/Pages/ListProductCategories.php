<?php

namespace App\Filament\Resources\ProductCategoryResource\Pages;

use App\Filament\Resources\ProductCategoryResource;
use App\Models\ProductCategory;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListProductCategories extends ListRecords
{
    protected static string $resource = ProductCategoryResource::class;

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
                ->badge(ProductCategory::where('lang', $lang)->count())
                ->modifyQueryUsing(function ($query) use ($lang) {
                    return $query->where('lang', $lang);
                });
        }
 
        return $tabs;
    }
}
