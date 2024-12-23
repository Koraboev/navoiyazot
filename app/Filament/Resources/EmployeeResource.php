<?php

namespace App\Filament\Resources;

use AmidEsfahani\FilamentTinyEditor\Tiny;
use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
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
use Filament\Tables\Table;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static ?string $navigationLabel = 'Сотрудники';
    protected static ?string $breadcrumb = 'Сотрудники';
    protected static ?string $pluralModelLabel = 'Сотрудники';
    protected static ?string $modelLabel = 'Сотрудник';
    
    protected static ?string $navigationIcon = 'heroicon-o-users';

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
                Section::make('')
                ->schema([
                    Grid::make(2)
                    ->schema([
                        TextInput::make('name')->label('Ф.И.О')
                        ->required(),
                        TextInput::make('job')->label('Профессия')
                        ->required()
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (Set $set, $state) {
                            $set('slug', Str::slug($state));
                        }),
                    ]),
                    Grid::make(3)
                    ->schema([
                        TextInput::make('number')->label('Номер телефона')
                        ->mask('(99) 999-99-99')
                        ->prefix(+998)
                        ->tel(),
                        TextInput::make('email')->email()->label('Электронная почта')
                        ->prefixIcon('heroicon-o-envelope'),
                        TextInput::make('messenger')->label('Социальная сеть')
                        ->prefixIcon('heroicon-o-paper-airplane'),
                    ]),
                    TinyEditor::make('info')->label('Информация о сотруднике'),
                    TextInput::make('slug')
                    ->readOnly(),
                    FileUpload::make('image')->deletable()->label('Изображение')
                    ->image()
                    ->optimize('webp')
                    ->directory('uploads/images')
                    ->disk('public'),
                    Toggle::make('show_home')->label('показать домашнюю страницу')
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')->label('Ф.И.О')
                ->searchable()
                ->sortable(),
                TextColumn::make('job')->limit(50)->label('Профессия'),
                ImageColumn::make('image')->label('Изображение'),
                IconColumn::make('show_home')->boolean()->label('показать Д/С'),
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}
