<?php

namespace App\Filament\Resources\PortalSettingResource\Pages;

use App\Filament\Resources\PortalSettingResource;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditPortalSetting extends EditRecord
{
    protected static string $resource = PortalSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('saveCustomPalette')
                ->label('💾 Save Custom Palette')
                ->color('warning')
                ->icon('heroicon-o-paint-brush')
                ->action(function () {
                    $data = $this->form->getState();

                    // Save only custom CSS palette
                    $this->record->update([
                        'custom_css' => $data['custom_css'] ?? null,
                    ]);

                    Notification::make()
                        ->success()
                        ->title('Custom Palette Saved')
                        ->body('Your @theme color palette has been saved and will be applied to both portals when selected.')
                        ->send();

                    $this->redirect($this->getResource()::getUrl('edit', ['record' => $this->record]));
                }),

            Action::make('saveStudentSettings')
                ->label('💾 Save Student Settings')
                ->color('primary')
                ->icon('heroicon-o-academic-cap')
                ->action(function () {
                    $data = $this->form->getState();

                    // Save only student theme preset
                    $this->record->update([
                        'active_theme' => $data['active_theme'] ?? 'custom',
                    ]);

                    Notification::make()
                        ->success()
                        ->title('Student Settings Saved')
                        ->body('Student portal theme preset has been updated.')
                        ->send();

                    $this->redirect($this->getResource()::getUrl('edit', ['record' => $this->record]));
                }),

            Action::make('saveAdminSettings')
                ->label('💾 Save Admin Settings')
                ->color('success')
                ->icon('heroicon-o-cog-6-tooth')
                ->action(function () {
                    $data = $this->form->getState();

                    // Save only admin theme
                    $this->record->update([
                        'admin_theme' => $data['admin_theme'] ?? 'frost-sapphire',
                    ]);

                    Notification::make()
                        ->success()
                        ->title('Admin Settings Saved')
                        ->body('Admin panel glassmorphic theme has been updated.')
                        ->send();

                    $this->redirect($this->getResource()::getUrl('edit', ['record' => $this->record]));
                }),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
