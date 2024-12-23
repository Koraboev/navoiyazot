<?php

namespace App\Filament\Resources;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubCategory;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
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
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $navigationGroup='Продукция';

    protected static ?string $navigationLabel = 'Продукция';
    protected static ?string $breadcrumb = 'Продукция';
    protected static ?string $pluralModelLabel = 'Продукция';
    protected static ?string $modelLabel = 'продукт';
    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';
    protected static ?int $navigationSort = 1;

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
                    ])->live(),
                    Toggle::make('seo')->label('SEO')->inline(false)->live(),
                ]),
                Section::make('')
                ->visible(fn(Get $get): bool => $get('seo'))
                ->schema([
                    TextInput::make('seo_title')->label('Meta title'),
                    Textarea::make('seo_description')->rows(3)->label('Meta Description'),
                ]),
                Section::make('Продукт')
                ->schema([
                    Grid::make()
                    ->schema([
                        TextInput::make('name')->label('Заголовок')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Set $set, $state) {
                            $set('slug', Str::slug($state));
                        }),
                        
                        Select::make('category_id')->label('Категория продукта')
                        ->required()
                        ->options(ProductCategory::all()->pluck('name', 'id')),
                        TextInput::make('slug')->required(),
                    ]),
                    TinyEditor::make('info')->label('Описание'),
                    FileUpload::make('image')->label('Изображение')->deletable()
                    ->image()
                    ->optimize('webp')
                    ->required()
                    ->directory('uploads/images')
                    ->disk('public'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Продукция')
                ->searchable()
                ->sortable(),
                TextColumn::make('slug'),
                ImageColumn::make('image')->label('Изображение'),
                TextColumn::make('Category.name')->label('Категория продукта')
                ->searchable()
                ->sortable(),
                IconColumn::make('seo')->boolean()->label('SEO'),
                TextColumn::make('lang')->badge()->color('success')->label('язык')
            ])
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }
}
