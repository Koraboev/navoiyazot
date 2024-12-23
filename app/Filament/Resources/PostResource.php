<?php

namespace App\Filament\Resources;

use AmidEsfahani\FilamentTinyEditor\TinyEditor;
use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Facades\Filament;
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

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationLabel = 'Новости';
    protected static ?string $breadcrumb = 'Новости';
    protected static ?string $pluralModelLabel = 'Новости';
    protected static ?string $modelLabel = 'Новости';
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

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
                    Select::make('type')->label('Выберите тип публикации')
                    ->required()
                    ->options([
                        'post' => 'Новост',
                        'gender' => 'Гендерное равенство',
                        'pride' => 'Наша гордость',
                        'public' => 'Публикации в СМИ',
                        'speech' => 'Тексты официальных выступлений',
                        'event' => 'Публичные мероприятия',
                        'tender' => 'Объявления о проведении конкурсов'
                    ]),
                    Toggle::make('seo')->label('SEO')->live()->inline(false),
                ]),
                Section::make()
                ->visible(fn(Get $get): bool => $get('seo'))
                ->schema([
                    TextInput::make('seo_title')->label('Meta title'),
                    Textarea::make('seo_description')->rows(3)->label('Meta Description'),
                ]),
                Section::make('')
                ->schema([
                    
                    TextInput::make('title')->label('Заголовок')
                    ->required()
                    ->live(onBlur: true)
                    ->afterStateUpdated(function (Set $set, $state, $record) {
                        $set('slug', Str::slug($state.'-'.Post::latest()->first()->id+1));
                    }),
                    TextInput::make('slug')->required(),
                  
                    TinyEditor::Make('text')->required()->label('Описание'),
                    FileUpload::make('image')->label('Изображение')->deletable()
                    ->image()
                    ->optimize('webp')
                    ->required()
                    ->multiple()
                    ->directory('uploads/images')
                    ->disk('public'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->limit(70)->label('Заголовок')
                ->searchable()
                ->sortable(),
                TextColumn::make('type')
                ->searchable()
                ->sortable(),
                ImageColumn::make('image')->limit(3)->label('Изображение'),
                //IconColumn::make('seo')->boolean()->label('SEO'),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
