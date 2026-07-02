<?php

namespace App\Filament\Resources\Motors\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MotorForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('brand_id')
                    ->label('Brand')
                    ->relationship('brand', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('motor_type_id')
                    ->label('Tipe Motor')
                    ->relationship('type', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('location_id')
                    ->label('Lokasi')
                    ->relationship('location', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                TextInput::make('name')
                    ->label('Nama Motor')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255),
                FileUpload::make('image_path')
                    ->label('Foto Motor')
                    ->image()
                    ->disk('public')
                    ->directory('motors')
                    ->imageEditor()
                    ->required(),
                TextInput::make('year')
                    ->label('Tahun')
                    ->numeric(),
                TextInput::make('cc')
                    ->label('CC')
                    ->required()
                    ->numeric(),
                Select::make('transmission')
                    ->label('Transmisi')
                    ->options([
                        'matic' => 'Matic',
                        'manual' => 'Manual',
                    ])
                    ->required(),
                TextInput::make('plate_number_masked')
                    ->label('Plat Nomor')
                    ->maxLength(255),
                TextInput::make('price_per_day')
                    ->label('Harga / Hari')
                    ->prefix('Rp')
                    ->required()
                    ->numeric(),
                TextInput::make('deposit_amount')
                    ->label('Deposit')
                    ->prefix('Rp')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('rating')
                    ->required()
                    ->numeric()
                    ->step(0.1)
                    ->default(4.8),
                TextInput::make('reviews_count')
                    ->label('Jumlah Review')
                    ->required()
                    ->numeric()
                    ->default(0),
                Select::make('status')
                    ->options([
                        'tersedia' => 'Tersedia',
                        'disewa' => 'Disewa',
                        'maintenance' => 'Maintenance',
                        'tidak tersedia' => 'Tidak Tersedia',
                    ])
                    ->required()
                    ->default('tersedia'),
                Select::make('tone')
                    ->options([
                        'blue' => 'Blue',
                        'green' => 'Green',
                        'orange' => 'Orange',
                        'red' => 'Red',
                        'purple' => 'Purple',
                    ])
                    ->required()
                    ->default('blue'),
                Textarea::make('description')
                    ->label('Deskripsi')
                    ->rows(4)
                    ->columnSpanFull(),
                Toggle::make('is_popular')
                    ->label('Motor Populer'),
            ]);
    }
}
