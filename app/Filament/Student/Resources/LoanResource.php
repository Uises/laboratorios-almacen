<?php

namespace App\Filament\Student\Resources;

use App\Filament\Student\Resources\LoanResource\Pages;
use App\Filament\Student\Resources\LoanResource\RelationManagers;
use App\Models\Loan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class LoanResource extends Resource
{
    protected static ?string $model = Loan::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationLabel = 'Prestamos';

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->where('user_id', Auth::user()->id)->orderBy('id', 'desc');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\Select::make('teacher_id')
                    ->relationship('teacher', 'name')
                    ->required(),
                Forms\Components\Select::make('laboratory_id')
                    ->relationship('laboratory', 'name')
                    ->required()
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('teacher.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('laboratory.name')
                    ->numeric()
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
                ->label('Ultima modificación')
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
