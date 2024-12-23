<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VideoGalleryResource\Pages;
use App\Filament\Resources\VideoGalleryResource\RelationManagers;
use App\Models\VideoGallery;
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

class VideoGalleryResource extends Resource
{
    protected static ?string $model = VideoGallery::class;
    protected static ?string $navigationGroup = 'Галерея';
    protected static ?string $navigationLabel = 'Видеогалерея';
    protected static ?string $breadcrumb = 'Видеогалерея';
    protected static ?string $pluralModelLabel = 'Видеогалерея';
    protected static ?string $modelLabel = 'Видеогалерея';
    protected static ?string $navigationIcon = 'heroicon-o-video-camera';

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
                    ])
                ]),
                Section::make()
                ->schema([
                    TextInput::make('name')->label('Заголовок')->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, $state) {
                        $set('slug', Str::slug($state));
                    }),
                    TextInput::make('slug'),
                    FileUpload::make('image')->label('Изображение')->deletable()
                    ->image()
                    ->optimize('webp')
                    ->directory('uploads/images')
                    ->required()
                    ->disk('public'),
                    TextInput::make('video')
                    ->label('Ссылка на видео')
                    ->prefixIcon('heroicon-o-link')
                    ->prefixIconColor('info')
                    ->required()
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
                ImageColumn::make('image')->label('Изображение'),
                TextColumn::make('lang')->badge()->color('success')->label('язык'),
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
            'index' => Pages\ListVideoGalleries::route('/'),
            'create' => Pages\CreateVideoGallery::route('/create'),
            'edit' => Pages\EditVideoGallery::route('/{record}/edit'),
        ];
    }
}
