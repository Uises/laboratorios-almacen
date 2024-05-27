<?php

namespace App\Filament\Resources\LoanResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ComponentRelationManager extends RelationManager
{
    protected static string $relationship = 'component';
    protected static ?string $title = 'Material';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('store_id')
                    ->required()
                    ->relationship('store','name_component'),
                    Forms\Components\TextInput::make('number')
                    ->required()
                    ->numeric()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('store_id')
            ->columns([
                Tables\Columns\TextColumn::make('store.name_component'),
                Tables\Columns\TextColumn::make('number'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()
                ->visible(function () {
                    $parentRecord = $this->getOwnerRecord();
                    return $parentRecord && $parentRecord->state_loan === 'on_loan';
                })
            ])
            ->actions([
                Tables\Actions\EditAction::make()
                ->visible(function () {
                    $parentRecord = $this->getOwnerRecord();
                    return $parentRecord && $parentRecord->state_loan === 'on_loan';
                }),
                Tables\Actions\DeleteAction::make()
                ->visible(function () {
                    $parentRecord = $this->getOwnerRecord();
                    return $parentRecord && $parentRecord->state_loan === 'on_loan';
                })
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
