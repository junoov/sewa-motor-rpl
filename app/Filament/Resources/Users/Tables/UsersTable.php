<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Nama')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('phone')
                    ->label('No. HP')
                    ->searchable()
                    ->toggleable(),
                TextColumn::make('role')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'admin' ? 'danger' : 'gray')
                    ->searchable(),
                TextColumn::make('verification_status')
                    ->label('Verifikasi')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'terverifikasi' => 'success',
                        'menunggu' => 'warning',
                        'ditolak' => 'danger',
                        default => 'gray',
                    })
                    ->searchable(),
                ImageColumn::make('ktp_path')
                    ->label('KTP')
                    ->square()
                    ->toggleable(isToggledHiddenByDefault: true),
                ImageColumn::make('sim_path')
                    ->label('SIM')
                    ->square()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('email_verified_at')
                    ->label('Email Verified')
                    ->dateTime('d M Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('created_at')
                    ->label('Daftar')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('role')
                    ->options([
                        'customer' => 'Customer',
                        'admin' => 'Admin',
                    ]),
                SelectFilter::make('verification_status')
                    ->label('Verifikasi')
                    ->options([
                        'belum diverifikasi' => 'Belum Diverifikasi',
                        'menunggu' => 'Menunggu',
                        'terverifikasi' => 'Terverifikasi',
                        'ditolak' => 'Ditolak',
                    ]),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->poll(null)
            ->persistSearchInSession()
            ->persistFiltersInSession();
    }
}
