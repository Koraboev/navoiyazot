<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FileResource\Pages;
use App\Filament\Resources\FileResource\RelationManagers;
use App\Models\File;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FileResource extends Resource
{
    protected static ?string $model = File::class;
    protected static ?string $navigationLabel = 'Медиа-файлы';
    protected static ?string $breadcrumb = 'Медиа-файл';
    protected static ?string $pluralModelLabel = 'Медиа-файлы';
    protected static ?string $modelLabel = 'Медиа-файл';
    protected static ?string $navigationIcon = 'heroicon-o-folder';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                ->schema([
                    TextInput::make('name')
                    ->required()
                    ->label('Названия')
                    ->hint('Этот текст предназначен для облегчения поиска файла.'),
                    FileUpload::make('link')->label('Файл')->deletable()
                    ->acceptedFileTypes(['application/pdf'])
                    ->required()
                    ->directory('uploads/files')
                    ->disk('public'),
                ])

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            
            ->columns([
                TextColumn::make('name')
                ->searchable()
                ->sortable()
                ->label('Названия')
                ->icon('heroicon-o-document-text')
                ->iconColor('warning')
                ->url(fn($record) => url()->to('/').'/storage/'.$record->link)
                ->openUrlInNewTab(),

                TextColumn::make('link')->label('Файл')
                ->formatStateUsing(function (string $state): string {
                    return url()->to('/').'/storage/'.$state;
                })
                ->copyable()
                ->copyableState(function ($record) {
                    return url()->to('/').'/storage/'.$record->link;
                })
                ->tooltip('нажмите на него, чтобы скопировать')
                ->icon('heroicon-o-link')
                ->iconColor('info'),
            ])->defaultSort('created_at', 'desc')
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
            'index' => Pages\ListFiles::route('/'),
            'create' => Pages\CreateFile::route('/create'),
            'edit' => Pages\EditFile::route('/{record}/edit'),
        ];
    }
}
