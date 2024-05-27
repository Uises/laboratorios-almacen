<?php

namespace App\Filament\Student\Resources\LoanResource\Pages;

use App\Filament\Student\Resources\LoanResource;
use App\Models\Loan;
use Filament\Actions;
use Filament\Forms\Components\Builder as ComponentsBuilder;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class ListLoans extends ListRecords
{
    protected static string $resource = LoanResource::class;

    protected static ?string $title = 'Mis Prestamos';



    protected function getHeaderActions(): array
    {

        $loans = Loan::where('user_id', Auth::user()->id)->where('state_loan', 'on_loan')->get();
        $loans->count() > 0 ? $visible = false : $visible = true;

        return [
            Actions\CreateAction::make()
                ->label('Solicitar material')
                ->visible($visible),
        ];
    }
}
