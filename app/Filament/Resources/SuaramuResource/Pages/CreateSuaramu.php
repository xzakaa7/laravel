<?php

namespace App\Filament\Resources\SuaramuResource\Pages;

use App\Filament\Resources\SuaramuResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSuaramu extends CreateRecord
{
    protected static string $resource = SuaramuResource::class;
      protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
