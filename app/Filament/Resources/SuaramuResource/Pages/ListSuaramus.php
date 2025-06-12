<?php

namespace App\Filament\Resources\SuaramuResource\Pages;

use App\Filament\Resources\SuaramuResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSuaramus extends ListRecords
{
    protected static string $resource = SuaramuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
