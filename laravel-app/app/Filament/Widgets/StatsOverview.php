<?php

namespace App\Filament\Widgets;

use App\Models\Page;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Toplam Sayfa', Page::count())
                ->description('Yayınlanan sayfalar')
                ->descriptionIcon('heroicon-m-document-text')
                ->color('success')
                ->chart([7, 2, 10, 3, 15, 4, 17]),

            Stat::make('Toplam Menü', Menu::count())
                ->description('Aktif menüler')
                ->descriptionIcon('heroicon-m-bars-3')
                ->color('info')
                ->chart([17, 16, 14, 15, 14, 13, 12]),

            Stat::make('Menü Öğeleri', MenuItem::count())
                ->description('Toplam menü öğesi')
                ->descriptionIcon('heroicon-m-link')
                ->color('warning')
                ->chart([15, 4, 10, 2, 12, 4, 7]),

            Stat::make('Kullanıcılar', User::count())
                ->description('Kayıtlı kullanıcılar')
                ->descriptionIcon('heroicon-m-users')
                ->color('danger')
                ->chart([3, 4, 5, 6, 7, 8, 9]),
        ];
    }
}
