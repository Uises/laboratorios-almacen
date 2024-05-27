<?php

namespace App\Filament\Student\Resources\LoanResource\Pages;

use App\Filament\Student\Resources\LoanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLoans extends ListRecords
{
    protected static string $resource = LoanResource::class;

    protected static ?string $title = 'Mis Prestamos';


    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
