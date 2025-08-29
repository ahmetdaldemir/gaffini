<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;

class ClockWeatherWidget extends Widget
{
    protected string $view = 'filament.widgets.clock-weather-widget';

    protected int | string | array $columnSpan = 1;

    public function getViewData(): array
    {
        // Basit hava durumu simülasyonu
        $weathers = [
            ['temp' => 22, 'condition' => 'Güneşli', 'icon' => '☀️'],
            ['temp' => 18, 'condition' => 'Bulutlu', 'icon' => '☁️'],
            ['temp' => 15, 'condition' => 'Yağmurlu', 'icon' => '🌧️'],
            ['temp' => 25, 'condition' => 'Açık', 'icon' => '🌤️'],
        ];

        $weather = $weathers[array_rand($weathers)];

        return [
            'currentTime' => now()->format('H:i:s'),
            'currentDate' => now()->format('d.m.Y'),
            'currentDay' => now()->format('l'),
            'temperature' => $weather['temp'],
            'condition' => $weather['condition'],
            'icon' => $weather['icon'],
            'city' => 'İstanbul',
        ];
    }
}
