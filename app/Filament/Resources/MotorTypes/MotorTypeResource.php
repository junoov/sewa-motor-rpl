<?php

namespace App\Filament\Resources\MotorTypes;

use App\Filament\Resources\MotorTypes\Pages\CreateMotorType;
use App\Filament\Resources\MotorTypes\Pages\EditMotorType;
use App\Filament\Resources\MotorTypes\Pages\ListMotorTypes;
use App\Filament\Resources\MotorTypes\Schemas\MotorTypeForm;
use App\Filament\Resources\MotorTypes\Tables\MotorTypesTable;
use App\Models\MotorType;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MotorTypeResource extends Resource
{
    protected static ?string $model = MotorType::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return MotorTypeForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MotorTypesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListMotorTypes::route('/'),
            'create' => CreateMotorType::route('/create'),
            'edit' => EditMotorType::route('/{record}/edit'),
        ];
    }
}
