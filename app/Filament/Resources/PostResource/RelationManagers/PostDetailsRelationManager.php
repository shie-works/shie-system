<?php

namespace App\Filament\Resources\PostResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components;
use Filament\Tables\Columns;

class PostDetailsRelationManager extends RelationManager
{
    protected static ?string $title = '詳細';
    protected static string $relationship = 'postDetail';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Components\TextInput::make('sub_title')
                    ->label('見出し')
                    ->required(),
                Components\MarkdownEditor::make('description')
                    ->label('概要')
                    ->required()
                    ->columnSpan(2),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('sub_title')
            ->columns([
                Columns\TextColumn::make('sub_title')->label('見出し'),
                Columns\TextColumn::make('description')->label('内容')->markdown(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
