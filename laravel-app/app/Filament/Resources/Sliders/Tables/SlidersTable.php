<?php

namespace App\Filament\Resources\Sliders\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;

class SlidersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('background_image')
                    ->label('Görsel')
                    ->circular()
                    ->size(60),
                
                TextColumn::make('title')
                    ->label('Ana Başlık')
                    ->searchable()
                    ->sortable()
                    ->limit(30),
                
                TextColumn::make('subtitle')
                    ->label('Alt Başlık')
                    ->searchable()
                    ->sortable()
                    ->limit(20),
                
                BadgeColumn::make('overlay_type')
                    ->label('Overlay')
                    ->colors([
                        'primary' => 'overlay-4',
                        'success' => 'overlay-5',
                        'warning' => 'none',
                    ])
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'overlay-4' => 'Koyu',
                        'overlay-5' => 'Açık',
                        'none' => 'Yok',
                        default => $state,
                    }),
                
                TextColumn::make('button_text')
                    ->label('Buton')
                    ->limit(15),
                
                ToggleColumn::make('is_active')
                    ->label('Aktif'),
                
                TextColumn::make('order')
                    ->label('Sıra')
                    ->sortable(),
                
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
