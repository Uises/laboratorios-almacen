<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LoanResource\Pages;
use App\Filament\Resources\LoanResource\RelationManagers;
use App\Models\Loan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LoanResource extends Resource
{
    protected static ?string $model = Loan::class;

    protected static ?string $navigationIcon = 'heroicon-o-pencil-square';
    protected static ?string  $navigationLabel = 'Prestamos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name')
                    ->required()
                    ->hiddenOn('edit'),
                Forms\Components\Select::make('state_loan')
                ->label('Estado del prestamo')
                    ->options([
                        'on_loan' => 'En prestamo',
                        'delivered' => 'Devuelto'
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('Estudiante')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.studentID')
                    ->label('Matrícula')
                    ->numeric()
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('user.career')
                    ->formatStateUsing(function ($state) {

                        $options1 = [
                            'Ing_computation' => 'Ingenieria en Computacion',
                            'Ing_electronics' => 'Ingenieria Electronica',
                            'Ing_electric' => 'Ingenieria Electrica'
                        ];

                        return $options1[$state] ?? $state;
                    })
                    ->label('Carrera')
                    ->sortable(),

                Tables\Columns\TextColumn::make('state_loan')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'on_loan' => 'warning',
                        'delivered' => 'success'
                    })
                    ->formatStateUsing(function ($state) {

                        $options = [
                            'on_loan' => 'En prestamo',
                            'delivered' => 'Entregado'
                        ];

                        return $options[$state] ?? $state;
                    })
                    ->label('Estado de prestamo'),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Fecha de prestamo')
                    ->dateTime()
                    ->sortable(),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([

                SelectFilter::make('state_loan')
                    ->options([
                        'on_loan' => 'En prestamo',
                        'delivered' => 'Entregado'
                    ])

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
            RelationManagers\ComponentRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListLoans::route('/'),
            'create' => Pages\CreateLoan::route('/create'),
            'edit' => Pages\EditLoan::route('/{record}/edit'),
        ];
    }
}
