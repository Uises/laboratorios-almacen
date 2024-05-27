<?php

namespace App\Filament\Student\Resources\LoanResource\Pages;

use App\Filament\Student\Resources\LoanResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateLoan extends CreateRecord
{
    protected static string $resource = LoanResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = Auth::user()->id;

        return $data;
    }
}
