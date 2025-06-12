<?php

namespace App\Filament\Widgets;

use App\Models\Pengguna;
use App\Models\Pengaduan;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;

class DashboardOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('Total Pengguna', Pengguna::count())
                ->description('Jumlah total pengguna terdaftar')
                ->icon('heroicon-o-users')
                ->color('success'),

            Card::make('Total Pengaduan', Pengaduan::count())
                ->description('Jumlah total pengaduan yang diterima')
                ->icon('heroicon-o-flag')
                ->color('danger'),
        ];
    }
}
