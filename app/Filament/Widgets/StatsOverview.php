<?php

namespace App\Filament\Widgets;

use App\Models\Pengguna;
use App\Models\pengaduan;
use App\Models\Suaramu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
         $admin = Auth::user()->name ?? 'Admin';
            $totalPengaduan = Pengaduan::count();

        // Ambil data jumlah pengaduan per hari
        $dailyPengaduan = Pengaduan::select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as count'))
            ->groupBy(DB::raw('DATE(created_at)'))
            ->orderBy('date')
            ->limit(7)  // Menampilkan data 7 hari terakhir
            ->pluck('count')
            ->toArray();

        return [
              Stat::make('Selamat Datang', $admin)
                ->description('Dashboard Aspira')
                ->descriptionIcon('heroicon-o-user'),
            Stat::make('Jumlah Pengguna', Pengguna::count())
                ->description('Total pengguna terdaftar')
                ->color('success')
                ->descriptionIcon('heroicon-o-users'),

            Stat::make('Jumlah Pengaduan', pengaduan::count())
                ->description('Semua pengaduan masuk')
                ->color('info'),
             //   ->descriptionIcon('heroicon-o-exclamation'),

            Stat::make('Pengaduan Diproses', Pengaduan::whereIn('status',[ 'diproses', 'dikirim'])->count())
                ->description('Sedang ditangani petugas')
                ->color('warning'),
           //     ->descriptionIcon('heroicon-o-clock'),

            Stat::make('Pengaduan Selesai', Pengaduan::where('status', 'ditangani')->count())
                ->description('Pengaduan yang telah selesai')
                ->color('success')
              //  ->descriptionIcon('heroicon-o-check-circle'),

              ,

                Stat::make('Jumlah Saran Rakyat', Suaramu::count())
                ->description('Semua Aspirasi Rakyat ')
                ->color('info'),
        ];
    }
}
