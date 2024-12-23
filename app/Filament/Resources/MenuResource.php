<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MenuResource\Pages;
use App\Filament\Resources\MenuResource\RelationManagers;
use App\Models\Menu;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MenuResource extends Resource
{
    protected static ?string $model = Menu::class;
    protected static ?string $navigationGroup='Общие данные';
    protected static ?string $navigationLabel = 'Меню';
    protected static ?string $breadcrumb = 'Меню';
    protected static ?string $pluralModelLabel = 'Меню';
    protected static ?string $modelLabel = 'Меню';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';

    public static function form(Form $form): Form
    {

        return $form
            ->schema([
                Section::make()
                ->schema([
                    Grid::make()
                    ->columns(3)
                    ->schema([
                        Select::make('lang')->label('Выберите язык')
                        ->required()
                        ->options([
                            'uz' => 'O`zbek',
                            'ru' => 'Русский',
                            'en' => 'English'
                        ])->live(),
                        Select::make('type')->label('Тип меню')
                        ->required()
                        ->options([
                            'menu'=>'Меню',
                            'page'=>'Страница',
                            'link'=>'Гиперссылка',
                            'product'=>'Категория продукта',
                            'feedback'=>'Форма обратной связи',
                            'appointment'=>'Онлайн запись на прием',
                            'consumer'=>'Опрос потребителей',
                        ])->live(),
                        Select::make('stage')->label('Уровень')
                        ->required()
                        ->options([
                            1 =>'Уровень 1',
                            2 =>'Уровень 2',
                            3 =>'Уровень 3',
                            4 =>'Уровень 4',
                            5 =>'Уровень 5',
                        ])->live(),
                    ]),
                    TextInput::make('name')->required()->label('Название'),
                    Grid::make()
                    ->columns(2)
                    ->schema([
                        Select::make('parent_id')->label('Родительское меню')
                        ->visible(fn (Get $get): bool => in_array($get('stage'), [2,3,4,5]))
                        ->options(Menu::All()->pluck('name','id')),
                        
                        TextInput::make('link')->label('Гиперссылка')
                        ->prefixIcon('heroicon-o-globe-alt')
                        ->visible(fn (Get $get): bool => $get('type') == 'link'),
                        
                        Select::make('page_id')->label('Страница')
                        ->visible(fn (Get $get): bool => in_array($get('type'), ['page','consumer','appointment','feedback']))
                        ->options(Page::all()->pluck('title', 'id')),
                    ])
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Название')
                ->searchable()
                ->sortable(),
                TextColumn::make('stage')->badge()->color('info')->label('Уровень')->sortable()->searchable(),
                TextColumn::make('ParentMenu.name')->label('Родительское меню'),
                TextColumn::make('type')->badge()->color('info')->label('Тип меню'),
                TextColumn::make('Page.title')->label('Страница'),
                TextColumn::make('lang')->badge()->color('success')->label('язык'),
            ])->defaultSort('name', 'desc')
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMenus::route('/'),
            'create' => Pages\CreateMenu::route('/create'),
            'view' => Pages\ViewMenu::route('/{record}'),
            'edit' => Pages\EditMenu::route('/{record}/edit'),
        ];
    }
}
