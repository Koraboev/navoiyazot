<?php

namespace App\Filament\Resources;

use App\Filament\Resources\HomeResource\Pages;
use App\Filament\Resources\HomeResource\RelationManagers;
use App\Models\Home;
use Filament\Forms;
use Filament\Forms\Components\Fieldset;
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
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HomeResource extends Resource
{
    protected static ?string $model = Home::class;
    protected static ?string $navigationGroup='Общие данные';
    protected static ?string $navigationLabel = 'Главная';

    protected static ?string $breadcrumb = 'Главная';
    protected static ?string $pluralModelLabel = 'Главная';
    protected static ?string $modelLabel = 'Главная';
    protected static ?string $navigationIcon = 'heroicon-o-home-modern';

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
                    ]),
                    Toggle::make('seo')->label('SEO')->live()->inline(false)
                ]),
                Section::make('SEO information')
                ->visible(fn(Get $get):bool => $get('seo'))
                ->schema([
                    TextInput::make('seo_title')->label('Meta title'),
                    Textarea::make('seo_description')->rows(3)->label('Meta Description'),
                ]),

                Section::make('Баннер')
                ->schema([
                    TextInput::make('banner_title')->label('Заголовок'),
                    Textarea::make('banner_text')->rows(6)->label('Текст'),
                    Textarea::make('banner_subtext')->rows(6)->label('Подтекст'),
                    // FileUpload::make('banner_video')->label('Video')
                    // ->directory('uploads/videos')
                    // ->disk('public'),
                    // TextInput::make('banner_video')->label('Ссылка на видео')
                    // ->prefixIcon('heroicon-o-link'),
                ]),
                Section::make('О нас')
                ->schema([
                    TextInput::make('about_title')->label('Заголовок'),
                    RichEditor::make('about_text')->label('Текст'),

                    Fieldset::make('Преимущества')
                    ->schema([
                        Textarea::make('about_advantage_1')->rows(5)->label('Текст 1'),
                        Textarea::make('about_advantage_2')->rows(5)->label('Текст 2'),
                        Textarea::make('about_advantage_3')->rows(5)->label('Текст 3'),
                        Textarea::make('about_advantage_4')->rows(5)->label('Текст 4'),
                    ]),
                    RichEditor::make('about_subtext')->label('Подтекст'),
                    Grid::make()
                        ->schema([
                            FileUpload::make('about_image_1')->label('Изображение')->deletable()
                            ->image()
                            ->optimize('webp')
                            ->directory('uploads/images')
                            ->disk('public'),
                            FileUpload::make('about_image_2')->label('Изображение')->deletable()
                            ->image()
                            ->optimize('webp')
                            ->directory('uploads/images')
                            ->disk('public'),                            
                        ]),

                ]),
                Section::make('О компании')
                
                ->schema([
                    TextInput::make('company_title')->label('Заголовок'),
                    Grid::make()
                    ->schema([
                        Textarea::make('company_mission')->rows(5)->label('Миссия компании'),
                        Textarea::make('company_history')->rows(5)->label('История компании'),
                        Fieldset::make('Почему Мы?')
                        ->schema([
                            Textarea::make('company_quality')->rows(5)->label('Качество компании'),
                            Textarea::make('company_innovation')->rows(5)->label('Инновации компании'),
                            Textarea::make('company_partnership')->rows(5)->label('Партнерство компании'),
                            Textarea::make('company_stability')->rows(5)->label('Стабильность компании'),
                        ])

                    ]),
                    Fieldset::make('Статистика')
                    ->columns(4)
                    ->schema([
                        TextInput::make('company_staffes')->numeric()->label('Сотрудники'),
                        TextInput::make('company_products')->numeric()->label('Наименований продукции'),
                        TextInput::make('company_age')->numeric()->label('Лет успешной работы'),
                        TextInput::make('company_divisions')->numeric()->label('Структурных подразделений'),
                    ]),
                    FileUpload::make('company_image')->label('Изображение')->deletable()
                    ->image()
                    ->optimize('webp')
                    ->directory('uploads/images')
                    ->disk('public'),
                ]),
                
                Section::make('Галерея')
                ->schema([
                    TextInput::make('gallery_title')->label('Заголовок')->required(),
                    Grid::make()
                    ->columns(3)
                    ->schema([
                        FileUpload::make('gallery_image_1')->label('Изображение')->placeholder('1')->deletable()
                        ->image()
                        ->optimize('webp')
                        ->directory('uploads/images')
                        ->disk('public'),
                        FileUpload::make('gallery_image_2')->label('Изображение')->placeholder('2')->deletable()
                        ->image()
                        ->optimize('webp')
                        ->directory('uploads/images')
                        ->disk('public'),
                        FileUpload::make('gallery_image_3')->label('Изображение')->placeholder('3')->deletable()
                        ->image()
                        ->optimize('webp')
                        ->directory('uploads/images')
                        ->disk('public'),
                    ]),
                    Grid::make()
                    ->columns(2)
                    ->schema([
                        FileUpload::make('gallery_image_4')->label('Изображение')->placeholder('4')->deletable()
                        ->image()
                        ->optimize('webp')
                        ->directory('uploads/images')
                        ->disk('public'),
                        FileUpload::make('gallery_image_5')->label('Изображение')->placeholder('5')->deletable()
                        ->image()
                        ->optimize('webp')
                        ->directory('uploads/images')
                        ->disk('public'),
                    ]),
                    Grid::make()
                    ->columns(3)
                    ->schema([
                        FileUpload::make('gallery_image_6')->label('Изображение')->placeholder('6')->deletable()
                        ->image()
                        ->optimize('webp')
                        ->directory('uploads/images')
                        ->disk('public'),
                        FileUpload::make('gallery_image_7')->label('Изображение')->placeholder('7')->deletable()
                        ->image()
                        ->optimize('webp')
                        ->directory('uploads/images')
                        ->disk('public'),
                        FileUpload::make('gallery_image_8')->label('Изображение')->placeholder('8')->deletable()
                        ->image()
                        ->optimize('webp')
                        ->directory('uploads/images')
                        ->disk('public'),
                    ])
                ]),
                Section::make('Нижний баннер')
                ->schema([
                    TextInput::make('videoblock_title')->label('Заголовок'),
                    Grid::make()
                    ->columns(3)
                    ->schema([
                        Textarea::make('videoblock_adv_1')->rows(4)->label('Текст 1'),
                        Textarea::make('videoblock_adv_2')->rows(4)->label('Текст 2'),
                        Textarea::make('videoblock_adv_3')->rows(4)->label('Текст 3'),
                    ]),
                    // FileUpload::make('videoblock_video')->label('Video')->deletable()
                    // ->directory('uploads/videos')
                    // ->disk('public'),
                    // TextInput::make('videoblock_video')->label('Ссылка на видео')
                    // ->prefixIcon('heroicon-o-link'),
                ]),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('banner_title')->label('Баннер заголовок'),
                TextColumn::make('about_title')->label('О заголовок'),
                //IconColumn::make('seo')->boolean()->label('SEO'),
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
            'index' => Pages\ListHomes::route('/'),
            'create' => Pages\CreateHome::route('/create'),
            'view' => Pages\ViewHome::route('/{record}'),
            'edit' => Pages\EditHome::route('/{record}/edit'),
        ];
    }
}
