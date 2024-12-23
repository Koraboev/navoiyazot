<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\Grid as ComponentsGrid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Group;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;
    protected static ?string $navigationGroup='Общие данные';
    protected static ?string $navigationLabel = 'Контакты';
    protected static ?string $breadcrumb = 'Контакты';
    protected static ?string $pluralModelLabel = 'Контакты';
    protected static ?string $modelLabel = 'Контакт';
    protected static ?string $navigationIcon = 'heroicon-o-identification';

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
                    ])
                ]),
                Section::make('Номера телефонов')
                ->icon('heroicon-m-phone')
                ->columns(3)
                ->schema([
                    TextInput::make('number_1')->label('Номер телефона - 1')
                    ->mask('(99) 999-99-99')
                    ->prefix(+998)
                    ->tel(),
                    TextInput::make('number_2')->label('Номер телефона - 2')
                    ->mask('(99) 999-99-99')
                    ->prefix(+998)
                    ->tel(),
                    TextInput::make('number_3')->label('Номер телефона - 3')
                    ->mask('(99) 999-99-99')
                    ->prefix(+998)
                    ->tel(),
                    TextInput::make('number_4')->label('Номер телефона - 4')
                    ->mask('(99) 999-99-99')
                    ->prefix(+998)
                    ->tel(),
                    TextInput::make('helpline')->label('Горячая линия')
                    ->mask('(99) 999-99-99')
                    ->prefix(+998)
                    ->tel(),
                ]),
                Section::make('Электронная почта')
                ->columns(2)
                ->schema([
                    TextInput::make('email_1')->prefixIcon('heroicon-o-envelope')->email(),
                    TextInput::make('email_2')->prefixIcon('heroicon-o-envelope')->email(),
                ]),
                Section::make('Социальные сети')
                ->columns(2)
                ->schema([
                    TextInput::make('telegram')->prefixIcon('heroicon-o-chat-bubble-left-right'),
                    TextInput::make('facebook')->prefixIcon('heroicon-o-chat-bubble-left-right'),
                    TextInput::make('instagram')->prefixIcon('heroicon-o-chat-bubble-left-right'),
                    TextInput::make('youtube')->prefixIcon('heroicon-o-chat-bubble-left-right'),
                ]),
                Section::make('Адреса')
                ->columns(2)
                ->schema([
                    TextInput::make('address')->label('Адрес')->prefixIcon('heroicon-o-home-modern'),
                    TextInput::make('map')->label('Google map')->prefixIcon('heroicon-o-globe-europe-africa'),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('number_1')->label('Номер телефона'),
                TextColumn::make('email_1')->label('Email'),
                TextColumn::make('address')->label('Адрес'),
                TextColumn::make('lang')->badge()->color('warning')->label('язык'),
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
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'view' => Pages\ViewContact::route('/{record}'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }
}
