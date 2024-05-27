<?php

namespace App\Filament\Student\Resources\LoanResource\RelationManagers;

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

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('store_id')
                ->label('Componente')
                ->relationship('store','name_component')
                ->required(),
                Forms\Components\TextInput::make('number')
                ->label('Cantidad')
                    ->required()
                    ->numeric()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
        ->emptyStateHeading('Sin componentes')
        ->emptyStateDescription('Añade componentes a tu prestamo')
            ->recordTitleAttribute('store_id')
            ->columns([
                Tables\Columns\TextColumn::make('store.name_component')
                ->label('Componente'),
                Tables\Columns\TextColumn::make('number')
                ->label('Cantidad')
            ])
            ->filters([
                //
            ])
            ->headerActions([

                Tables\Actions\CreateAction::make()
                ->label('Añadir componente'),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
