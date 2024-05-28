<?php

namespace App\Filament\Pages\Customizations;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Login;

class LoginStudent extends Login
{

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('studentID')
                ->label('Matrícula')
                ->required(),
                $this->getPasswordFormComponent()
            ]);
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        return [
            'studentID' => $data['studentID'],
            'password' => $data['password'],
        ];
    }


}

