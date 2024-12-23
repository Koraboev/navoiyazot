<?php

namespace App\Filament\Resources;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Resources\PageResource\Pages;
use App\Filament\Resources\PageResource\RelationManagers;
use App\Filament\Resources\PageResource\RelationManagers\FilesRelationManager;
use App\Models\Page;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PageResource extends Resource
{
    protected static ?string $model = Page::class;

    protected static ?string $navigationLabel = 'Страницы';
    protected static ?string $breadcrumb = 'Страницы';
    protected static ?string $pluralModelLabel = 'Страницы';
    protected static ?string $modelLabel = 'Страница';
    protected static ?string $navigationIcon = 'heroicon-o-square-3-stack-3d';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()
                ->columns(5)
                ->schema([
                    Select::make('lang')->label('Выберите язык')
                    ->required()
                    ->options([
                        'uz' => 'O`zbek',
                        'ru' => 'Русский',
                        'en' => 'English'
                    ]),
                    Select::make('type')->label('Тип страницы')
                    ->options([
                        'По умолчанию' => 'По умолчанию',
                        'vacancy' => 'Vacancy',
                    ])->live(),
                    Toggle::make('status')->label('Показать?')
                    ->visible(fn (Get $get): bool => ($get('type') == 'vacancy'))
                    ->inline(false),

                    Toggle::make('seo')->label('SEO')
                    ->inline(false)
                    ->required()->live()
                ]),
                Section::make()
                ->visible(fn (Get $get): bool => $get('seo'))
                ->schema([
                    //RichEditor::make('short_description'),
                    TextInput::make('seo_title')->label('Meta title'),
                    Textarea::make('seo_description')->rows(3)->label('Meta Description'),

                ]),

                Section::make()
                ->schema([
                    Grid::make()
                    ->columns(2)
                    ->schema([
                        TextInput::make('title')->required()
                        ->label('Заголовок')
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Set $set, $state) {
                            $set('slug', Str::slug($state));
                        }),
                        TextInput::make('slug')->required()
                    ]),
                    TinyEditor::make('description')->label('Описание'),
                    
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('Заголовок')
                ->searchable()
                ->sortable(),
                TextColumn::make('slug'),
                //IconColumn::make('seo')->boolean(),
                TextColumn::make('lang')->badge()->color('success')->label('язык'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
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
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'view' => Pages\ViewPage::route('/{record}'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }
}
