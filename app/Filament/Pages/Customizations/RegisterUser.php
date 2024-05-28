<?php

namespace App\Filament\Pages\Customizations;

use App\Models\Team;
use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Pages\Auth\Register;

class RegisterUser extends Register
{
    public static function getLabel(): string
    {
        return 'Register team';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                
                $this->getNameFormComponent(),
                $this->getEmailFormComponent(),
                TextInput::make('studetID')
                ->label('Matrícula')
                ->required(),
                Select::make('career')
                ->required()
                ->label('Carrera')
                ->options([
                    'Ing_computation' => 'Ingenieria en Computacion',
                    'Ing_electronics' => 'Ingenieria en Electrónica',
                    'Ing_electric' => 'Ingenieria en Eléctrica'
                ]),
                $this->getPasswordFormComponent(),
                $this->getPasswordConfirmationFormComponent(),


            ]);
    }

    protected function handleRegistration(array $data): User
    {
        $team = User::create($data);

        $team->members()->attach(auth()->user());

        return $team;
    }
}
