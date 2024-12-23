<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductCategoryResource\Pages;
use App\Filament\Resources\ProductCategoryResource\RelationManagers;
use App\Models\ProductCategory;
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
use Illuminate\Support\Str;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductCategoryResource extends Resource
{
    protected static ?string $model = ProductCategory::class;
    protected static ?string $navigationGroup = 'Продукция';
    protected static ?string $navigationLabel = 'Категория';
    protected static ?string $breadcrumb = 'Категория';
    protected static ?string $pluralModelLabel = 'Категория';
    protected static ?string $modelLabel = 'Категория';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-group';
    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(5)
                ->schema([
                    Select::make('lang')->label('Выберите язык')
                    ->required()
                    ->options([
                        'uz' => 'O`zbek',
                        'ru' => 'Русский',
                        'en' => 'English'
                    ]),
                    Toggle::make('seo')->label('SEO')->inline(false)->live()
                ]),
                Section::make('')
                ->visible(fn(Get $get):bool => $get('seo'))
                ->schema([
                    TextInput::make('seo_title')->label('Meta title'),
                    Textarea::make('seo_description')->rows(3)->label('Meta Description'),
                ]),
                Section::make('')
                ->schema([
                    Grid::make()
                    ->columns(2)
                    ->schema([
                        TextInput::make('name')->label('Категория')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Set $set, $state) {
                            $set('slug', Str::slug($state));
                        }),
                        TextInput::make('slug')->required(),
                    ]),
                FileUpload::make('image')->label('Изображение')->deletable()
                ->image()
                ->optimize('webp')
                ->required()
                ->directory('uploads/images')
                ->disk('public')
                ]),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Категория')
                ->searchable()
                ->sortable(),
                TextColumn::make('slug'),
                ImageColumn::make('image')->label('Изображение'),
                TextColumn::make('lang')->badge()->color('warning')->label('язык'),
            ])
            ->defaultSort('created_at', 'desc')
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
            'index' => Pages\ListProductCategories::route('/'),
            'create' => Pages\CreateProductCategory::route('/create'),
            'edit' => Pages\EditProductCategory::route('/{record}/edit'),
        ];
    }
}
