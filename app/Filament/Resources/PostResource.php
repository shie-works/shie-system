<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components;
use Filament\Tables\Columns;

class PostResource extends Resource
{
    protected static ?string $navigationGroup = '記事';
    protected static ?string $modelLabel = '記事管理';
    protected static ?int $navigationSort = 10;
    protected static ?string $navigationIcon = 'heroicon-o-document';
    protected static ?string $model = Post::class;

    // protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\TextInput::make('title')->label('タイトル')->required()
                    ->columnSpan(1),
                Components\Select::make('post_category_id')
                    ->relationship('postCategory', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->createOptionForm([
                        Components\TextInput::make('name')
                            ->label('カテゴリ名')
                            ->required(),
                        Components\TextInput::make('order')->label('並び順')->numeric()->required(),
                    ])
                    ->columnSpan(1),
                Components\MarkdownEditor::make('description')->label('概要')->required()
                    ->columnSpan(2),
                // Components\TextInput::make('order')->label('並び順')->numeric()->required(),
            ]);
        // ->columns(1);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Columns\TextColumn::make('postCategory.name')->label('カテゴリ'),
                Columns\TextColumn::make('title')->label('記事タイトル'),
                Columns\TextColumn::make('description')->label('概要')->markdown(),
            ])
            ->filters([
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(),
                    Tables\Actions\RestoreBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\PostDetailsRelationManager::class,
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
