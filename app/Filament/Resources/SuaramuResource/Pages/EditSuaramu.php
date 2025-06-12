<?php

namespace App\Filament\Resources\SuaramuResource\Pages;

use App\Filament\Resources\SuaramuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSuaramu extends EditRecord
{
    protected static string $resource = SuaramuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
