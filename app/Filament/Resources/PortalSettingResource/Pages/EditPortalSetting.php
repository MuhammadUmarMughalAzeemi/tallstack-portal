<?php

namespace App\Filament\Resources\PortalSettingResource\Pages;

use App\Filament\Resources\PortalSettingResource;
use Filament\Resources\Pages\EditRecord;

class EditPortalSetting extends EditRecord
{
    protected static string $resource = PortalSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
