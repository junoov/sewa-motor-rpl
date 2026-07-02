<?php

namespace App\Filament\Resources\Bookings\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class BookingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('order_number')
                    ->label('No. Order')
                    ->required()
                    ->maxLength(255),
                Select::make('user_id')
                    ->label('Customer')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('motor_id')
                    ->label('Motor')
                    ->relationship('motor', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('pickup_location_id')
                    ->label('Lokasi Ambil')
                    ->relationship('pickupLocation', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                DatePicker::make('start_date')
                    ->label('Tanggal Mulai')
                    ->required(),
                DatePicker::make('end_date')
                    ->label('Tanggal Selesai')
                    ->required(),
                TextInput::make('duration_days')
                    ->label('Durasi Hari')
                    ->required()
                    ->numeric(),
                TextInput::make('subtotal')
                    ->prefix('Rp')
                    ->required()
                    ->numeric(),
                TextInput::make('deposit_amount')
                    ->label('Deposit')
                    ->prefix('Rp')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('total_price')
                    ->label('Total')
                    ->prefix('Rp')
                    ->required()
                    ->numeric(),
                Select::make('status')
                    ->options([
                        'menunggu pembayaran' => 'Menunggu Pembayaran',
                        'menunggu konfirmasi' => 'Menunggu Konfirmasi',
                        'dikonfirmasi' => 'Dikonfirmasi',
                        'berjalan' => 'Berjalan',
                        'selesai' => 'Selesai',
                        'dibatalkan' => 'Dibatalkan',
                    ])
                    ->required()
                    ->default('menunggu pembayaran'),
                Textarea::make('notes')
                    ->label('Catatan')
                    ->rows(4)
                    ->columnSpanFull(),
                DateTimePicker::make('terms_accepted_at')
                    ->label('Syarat Disetujui')
                    ->required(),
            ]);
    }
}
