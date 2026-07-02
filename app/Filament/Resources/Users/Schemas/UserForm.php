<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('Nama')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                TextInput::make('phone')
                    ->label('No. HP')
                    ->tel()
                    ->maxLength(255),
                Select::make('role')
                    ->options([
                        'customer' => 'Customer',
                        'admin' => 'Admin',
                    ])
                    ->required()
                    ->default('customer'),
                Textarea::make('address')
                    ->label('Alamat')
                    ->rows(3)
                    ->columnSpanFull(),
                FileUpload::make('ktp_path')
                    ->label('KTP')
                    ->image()
                    ->directory('documents/ktp')
                    ->imageEditor(),
                FileUpload::make('sim_path')
                    ->label('SIM')
                    ->image()
                    ->directory('documents/sim')
                    ->imageEditor(),
                Select::make('verification_status')
                    ->label('Status Verifikasi')
                    ->options([
                        'belum diverifikasi' => 'Belum Diverifikasi',
                        'menunggu' => 'Menunggu',
                        'terverifikasi' => 'Terverifikasi',
                        'ditolak' => 'Ditolak',
                    ])
                    ->required()
                    ->default('belum diverifikasi'),
                DateTimePicker::make('email_verified_at')
                    ->label('Email Verified At'),
                TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->required(fn (string $operation): bool => $operation === 'create')
                    ->dehydrated(fn (?string $state): bool => filled($state))
                    ->maxLength(255),
            ]);
    }
}
