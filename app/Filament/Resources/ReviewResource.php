<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Filament\Resources\ReviewResource\RelationManagers;
use App\Models\Review;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationLabel = 'Oтзывы';
    protected static ?string $breadcrumb = 'Oтзывы';
    protected static ?string $pluralModelLabel = 'Oтзывы';
    protected static ?string $modelLabel = 'Oтзыв';
    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-left-right';

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
                Section::make('Oтзывы')
                ->schema([
                    Grid::make()
                    ->schema([
                        TextInput::make('company')->required()->label('Компания')
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Set $set, $state) {
                            $set('slug', Str::slug($state));
                        }),

                        TextInput::make('name')->label('Ф.И.О')
                        ->required(),

                        TextInput::make('slug')->required(),
                        
                    ]),
                    RichEditor::make('text')->label('Описание')->required(),
                    FileUpload::make('image')->label('Изображение')->deletable()
                    ->image()
                    ->optimize('webp')
                    ->required()
                    ->directory('uploads/images')
                    ->disk('public'),
                    Toggle::make('show_home')->label('Показать домашнюю страницу?')
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('company')->label('Компания')
                ->searchable()
                ->sortable(),
                TextColumn::make('name')->label('Ф.И.О'),
                ImageColumn::make('image')->label('Изображение'),
                IconColumn::make('show_home')->boolean()->label('Показать Д/С'),
                TextColumn::make('lang')->badge()->color('success')->label('язык')
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
            'index' => Pages\ListReviews::route('/'),
            'create' => Pages\CreateReview::route('/create'),
            'view' => Pages\ViewReview::route('/{record}'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }
}
