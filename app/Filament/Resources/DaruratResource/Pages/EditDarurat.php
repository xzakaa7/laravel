<?php

namespace App\Filament\Resources\DaruratResource\Pages;

use App\Filament\Resources\DaruratResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDarurat extends EditRecord
{
    protected static string $resource = DaruratResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
