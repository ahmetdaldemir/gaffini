<?php

namespace App\Filament\Resources\Sliders\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class SliderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Ana Başlık')
                    ->required()
                    ->maxLength(255)
                    ->placeholder('Örn: Transform Your Space')
                    ->helperText('Slider\'ın ana başlığı'),
                
                TextInput::make('subtitle')
                    ->label('Alt Başlık')
                    ->maxLength(255)
                    ->placeholder('Örn: Premium Flooring')
                    ->helperText('Slider\'ın alt başlığı (küçük metin)'),
                
                Textarea::make('description')
                    ->label('Açıklama')
                    ->rows(3)
                    ->maxLength(500)
                    ->placeholder('Slider açıklaması...')
                    ->helperText('Slider\'ın açıklama metni'),
                
                FileUpload::make('background_image')
                    ->label('Arka Plan Görseli')
                    ->image()
                    ->imageEditor()
                    ->imageCropAspectRatio('16:9')
                    ->imageResizeTargetWidth('1920')
                    ->imageResizeTargetHeight('1080')
                    ->directory('sliders/backgrounds')
                    ->visibility('public')
                    ->required()
                    ->helperText('Slider arka plan görseli (1920x1080 önerilen)')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                    ->maxSize(5120),
                
                Select::make('overlay_type')
                    ->label('Overlay Türü')
                    ->options([
                        'overlay-4' => 'Overlay 4 (Koyu)',
                        'overlay-5' => 'Overlay 5 (Açık)',
                        'none' => 'Overlay Yok',
                    ])
                    ->default('overlay-4')
                    ->helperText('Görsel üzerindeki overlay efekti'),
                
                TextInput::make('button_text')
                    ->label('Buton Metni')
                    ->maxLength(100)
                    ->placeholder('Örn: Our Services')
                    ->helperText('Buton üzerindeki metin'),
                
                TextInput::make('button_url')
                    ->label('Buton URL')
                    ->maxLength(255)
                    ->placeholder('Örn: /services')
                    ->helperText('Buton tıklandığında gidilecek adres'),
                
                Select::make('button_target')
                    ->label('Buton Hedefi')
                    ->options([
                        '_self' => 'Aynı Pencere',
                        '_blank' => 'Yeni Pencere',
                    ])
                    ->default('_self')
                    ->helperText('Butonun nasıl açılacağı'),
                
                Toggle::make('is_active')
                    ->label('Aktif')
                    ->default(true)
                    ->helperText('Slider\'ın görünür olup olmadığı'),
                
                TextInput::make('order')
                    ->label('Sıralama')
                    ->numeric()
                    ->default(0)
                    ->helperText('Slider sıralaması (0 = en üst)'),
            ]);
    }
}
