<?php

namespace App\Filament\Resources\SiteSettings\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Schemas\Schema;

class SiteSettingForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('key')
                    ->label('Anahtar')
                    ->required()
                    ->helperText('Ayar için benzersiz anahtar (örn: site_logo, site_favicon)'),
                Select::make('type')
                    ->label('Tür')
                    ->options([
                        'text' => 'Metin',
                        'textarea' => 'Çok Satırlı Metin',
                        'image' => 'Görsel',
                        'file' => 'Dosya',
                        'url' => 'URL',
                        'email' => 'E-posta',
                        'phone' => 'Telefon',
                        'number' => 'Sayı',
                        'boolean' => 'Evet/Hayır',
                    ])
                    ->required()
                    ->default('text')
                    ->helperText('Ayarın türü'),
                TextInput::make('group')
                    ->label('Grup')
                    ->required()
                    ->default('general')
                    ->helperText('Ayarları gruplamak için (örn: general, contact, social)'),
                TextInput::make('label')
                    ->label('Etiket')
                    ->required()
                    ->helperText('Kullanıcı dostu etiket'),
                Textarea::make('description')
                    ->label('Açıklama')
                    ->rows(2)
                    ->helperText('Ayar hakkında açıklama')
                    ->columnSpanFull(),
                
                // Koşullu alanlar
                TextInput::make('value')
                    ->label('Değer')
                    ->helperText('Ayar değeri')
                    ->visible(fn ($get) => in_array($get('type'), ['text', 'url', 'email', 'phone', 'number']))
                    ->columnSpanFull(),
                
                Textarea::make('value')
                    ->label('Değer')
                    ->rows(3)
                    ->helperText('Ayar değeri')
                    ->visible(fn ($get) => $get('type') === 'textarea')
                    ->columnSpanFull(),
                
                FileUpload::make('value')
                    ->label('Görsel')
                    ->image()
                    ->imageEditor()
                    ->imageCropAspectRatio('16:9')
                    ->imageResizeTargetWidth('800')
                    ->imageResizeTargetHeight('450')
                    ->directory('site-settings/images')
                    ->visibility('public')
                    ->helperText('Site ayarları için görsel (Logo, Favicon vb.)')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp', 'image/svg+xml'])
                    ->maxSize(2048)
                    ->visible(fn ($get) => $get('type') === 'image')
                    ->columnSpanFull(),
                
                FileUpload::make('value')
                    ->label('Dosya')
                    ->directory('site-settings/files')
                    ->visibility('public')
                    ->helperText('Site ayarları için dosya')
                    ->acceptedFileTypes(['application/pdf', 'text/plain', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                    ->maxSize(5120)
                    ->visible(fn ($get) => $get('type') === 'file')
                    ->columnSpanFull(),
                
                Select::make('value')
                    ->label('Değer')
                    ->options([
                        '1' => 'Evet',
                        '0' => 'Hayır',
                    ])
                    ->default('1')
                    ->helperText('Ayar değeri')
                    ->visible(fn ($get) => $get('type') === 'boolean'),
            ]);
    }
}
