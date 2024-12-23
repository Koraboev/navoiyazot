<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PhotoGalleryResource\Pages;
use App\Filament\Resources\PhotoGalleryResource\RelationManagers;
use App\Models\PhotoGallery;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PhotoGalleryResource extends Resource
{
    protected static ?string $model = PhotoGallery::class;
    protected static ?string $navigationGroup='Галерея';
    protected static ?string $navigationLabel = 'Фотогалерея';
    protected static ?string $breadcrumb = 'Фотогалерея';
    protected static ?string $pluralModelLabel = 'Фотогалерея';
    protected static ?string $modelLabel = 'Фотогалерея';
    protected static ?string $navigationIcon = 'heroicon-o-photo';

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
                ]),
                Section::make()
                ->schema([
                    TextInput::make('name')->required()
                    ->label('Заголовок')
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, $state) {
                        $set('slug', Str::slug($state));
                    }),
                    TextInput::make('slug')->required(),
                    FileUpload::make('images')->multiple()->label('Изображение')->deletable()
                    ->image()
                    ->optimize('webp')
                    ->directory('uploads/images')
                    ->required()
                    ->disk('public'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Заголовок')
                ->searchable()
                ->sortable(),
                ImageColumn::make('images')->limit(3)->label('Изображение'),
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
            'index' => Pages\ListPhotoGalleries::route('/'),
            'create' => Pages\CreatePhotoGallery::route('/create'),
            'edit' => Pages\EditPhotoGallery::route('/{record}/edit'),
        ];
    }
}
