<?php

namespace App\Filament\Resources\PortalSettingResource\Pages;

use App\Filament\Resources\PortalSettingResource;
use Filament\Resources\Pages\ListRecords;

class ListPortalSettings extends ListRecords
{
    protected static string $resource = PortalSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
