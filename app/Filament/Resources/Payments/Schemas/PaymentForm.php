<?php

namespace App\Filament\Resources\Payments\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PaymentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('booking_id')
                    ->label('Booking')
                    ->relationship('booking', 'order_number')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('method')
                    ->label('Metode')
                    ->options([
                        'transfer bank' => 'Transfer Bank',
                        'e-wallet' => 'E-Wallet',
                        'cash' => 'Cash',
                    ])
                    ->required()
                    ->default('transfer bank'),
                TextInput::make('amount')
                    ->label('Jumlah')
                    ->prefix('Rp')
                    ->required()
                    ->numeric(),
                FileUpload::make('proof_path')
                    ->label('Bukti Bayar')
                    ->image()
                    ->directory('payment-proofs')
                    ->imageEditor(),
                Select::make('status')
                    ->options([
                        'menunggu' => 'Menunggu',
                        'valid' => 'Valid',
                        'ditolak' => 'Ditolak',
                        'expired' => 'Expired',
                    ])
                    ->required()
                    ->default('menunggu'),
                DateTimePicker::make('paid_at')
                    ->label('Dibayar Pada'),
                DateTimePicker::make('expires_at')
                    ->label('Expired Pada'),
            ]);
    }
}
