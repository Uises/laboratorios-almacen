<?php

namespace App\Filament\Student\Resources\ComponentResource\Pages;

use App\Filament\Student\Resources\ComponentResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditComponent extends EditRecord
{
    protected static string $resource = ComponentResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
