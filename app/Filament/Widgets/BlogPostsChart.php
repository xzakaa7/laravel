<?php

namespace App\Filament\Widgets;

use App\Models\Pengaduan;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PengaduanPerHariChart extends ChartWidget
{
  //  protected static ?string $maxHeight = '300px';
      //protected int | string | array $columnSpan = 'full';
    protected static ?string $heading = 'Grafik Jumlah Pengaduan per Hari (30 Hari Terakhir)';

    protected function getData(): array
    
    {
        // Ambil data pengaduan 30 hari terakhir, dikelompokkan per tanggal
        $pengaduanPerHari = Pengaduan::selectRaw('DATE(created_at) as tanggal, COUNT(*) as jumlah')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->pluck('jumlah', 'tanggal');

        $labels = [];
        $data = [];

        // Isi data per hari (past 30 days)
        for ($i = 29; $i >= 0; $i--) {
            $tanggal = Carbon::now()->subDays($i)->toDateString();
            $labels[] = Carbon::now()->subDays($i)->format('d M'); // contoh: "13 May"
            $data[] = $pengaduanPerHari[$tanggal] ?? 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Jumlah Pengaduan',
                    'data' => $data,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line'; // atau 'bar' jika ingin batang
    }
}
