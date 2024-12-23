<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PartnerResource\Pages;
use App\Filament\Resources\PartnerResource\RelationManagers;
use App\Models\Partner;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Nette\Utils\ImageColor;

class PartnerResource extends Resource
{
    protected static ?string $model = Partner::class;
    protected static ?string $navigationGroup='Общие данные';
    protected static ?string $navigationLabel = 'Партнеры';
    protected static ?string $breadcrumb = 'Партнеры';
    protected static ?string $pluralModelLabel = 'Партнеры';
    protected static ?string $modelLabel = 'Партнер';
    protected static ?string $navigationIcon = 'heroicon-o-arrows-right-left';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Партнеры')
                ->schema([
                    TextInput::make('name')->label('Название компании'),
                    TextInput::make('link')->label('Ссылка на сайт компании'),
                    FileUpload::make('image')->label('Изображение')->deletable()
                    ->image()
                    ->optimize('webp')
                    ->required()
                    ->directory('uploads/images')
                    ->disk('public')
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Название компании'),
                TextColumn::make('link')->label('ссылка'),
                ImageColumn::make('image')->label('Изображение')
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
            'index' => Pages\ListPartners::route('/'),
            'create' => Pages\CreatePartner::route('/create'),
            'edit' => Pages\EditPartner::route('/{record}/edit'),
        ];
    }
}
