<?php

namespace App\Filament\Student\Resources\ComponentResource\Pages;

use App\Filament\Student\Resources\ComponentResource;
use App\Models\Loan;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateComponent extends CreateRecord
{
    protected static string $resource = ComponentResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        //$data['user_id'] = Auth::user()->id;

        $loan = Loan::all()->first();
        $loan = Loan::where('user_id',Auth::user()->id)->orderBy('id', 'desc')->first();


        //dd($loan);
        $data['loan_id'] = $loan->id;

        return $data;
    }
}
