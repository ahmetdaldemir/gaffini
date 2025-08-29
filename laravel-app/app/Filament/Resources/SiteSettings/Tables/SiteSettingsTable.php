<?php

namespace App\Filament\Resources\SiteSettings\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;

class SiteSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('key')
                    ->label('Anahtar')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('label')
                    ->label('Etiket')
                    ->searchable()
                    ->sortable(),
                BadgeColumn::make('type')
                    ->label('Tür')
                    ->colors([
                        'primary' => 'text',
                        'success' => 'image',
                        'warning' => 'file',
                        'info' => 'url',
                        'danger' => 'boolean',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'text' => 'Metin',
                        'textarea' => 'Çok Satırlı',
                        'image' => 'Görsel',
                        'file' => 'Dosya',
                        'url' => 'URL',
                        'email' => 'E-posta',
                        'phone' => 'Telefon',
                        'number' => 'Sayı',
                        'boolean' => 'Evet/Hayır',
                        default => $state,
                    }),
                BadgeColumn::make('group')
                    ->label('Grup')
                    ->colors([
                        'primary' => 'general',
                        'success' => 'contact',
                        'warning' => 'social',
                        'info' => 'seo',
                    ]),
                ImageColumn::make('value')
                    ->label('Görsel')
                    ->circular()
                    ->size(40)
                    ->visible(fn ($record) => $record && $record->type === 'image'),
                TextColumn::make('value')
                    ->label('Değer')
                    ->limit(50)
                    ->visible(fn ($record) => $record && $record->type !== 'image'),
                TextColumn::make('created_at')
                    ->label('Oluşturulma')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Güncellenme')
                    ->dateTime('d.m.Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
