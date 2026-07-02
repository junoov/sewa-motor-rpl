<?php

namespace App\Filament\Resources\MotorTypes\Pages;

use App\Filament\Resources\MotorTypes\MotorTypeResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListMotorTypes extends ListRecords
{
    protected static string $resource = MotorTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
