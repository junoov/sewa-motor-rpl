<?php

namespace App\Filament\Resources\MotorTypes\Pages;

use App\Filament\Resources\MotorTypes\MotorTypeResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditMotorType extends EditRecord
{
    protected static string $resource = MotorTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
