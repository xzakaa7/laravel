<?php

namespace App\Filament\Resources\DaruratResource\Pages;

use App\Filament\Resources\DaruratResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDarurats extends ListRecords
{
    protected static string $resource = DaruratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
