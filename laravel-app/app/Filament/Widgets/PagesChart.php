<?php

namespace App\Filament\Widgets;

use App\Models\Page;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Carbon;

class PagesChart extends ChartWidget
{
    protected ?string $heading = 'Sayfa İstatistikleri';

    protected function getData(): array
    {
        $days = collect();
        for ($i = 6; $i >= 0; $i--) {
            $days->push(Carbon::now()->subDays($i)->format('d.m'));
        }

        $data = $days->map(function ($day) {
            return Page::whereDate('created_at', Carbon::createFromFormat('d.m', $day))->count();
        });

        return [
            'datasets' => [
                [
                    'label' => 'Yeni Sayfalar',
                    'data' => $data->toArray(),
                    'borderColor' => '#10B981',
                    'backgroundColor' => 'rgba(16, 185, 129, 0.1)',
                ],
            ],
            'labels' => $days->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
