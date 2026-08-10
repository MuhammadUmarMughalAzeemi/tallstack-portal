<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PortalSettingResource\Pages;
use App\Models\PortalSetting;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;

class PortalSettingResource extends Resource
{
    protected static ?string $model = PortalSetting::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-paint-brush';

    protected static ?string $navigationLabel = 'Portal Theme Settings';

    protected static ?string $modelLabel = 'Portal Theme Setting';

    protected static ?string $pluralModelLabel = 'Portal Theme Settings';

    protected static ?int $navigationSort = 2;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('🎓 Student Portal Theme Settings')
                    ->description('Configure the theme, presets, and custom @theme color palettes for candidate multi-step application forms and student dashboards.')
                    ->components([
                        Select::make('active_theme')
                            ->label('Student Default Preset')
                            ->options([
                                'custom' => '⚙️ Custom Color Palette / Custom @theme CSS',
                            ])
                            ->default('custom')
                            ->nullable(),

                        Select::make('admin_theme')
                            ->label('Admin Panel Skeuo-Glass Theme')
                            ->options([
                                'custom-glass' => '✨ Custom @theme Glass (Auto-Generated)',
                                'frost-sapphire' => 'Frost Sapphire',
                                'emerald-glass' => 'Emerald Glass',
                                'obsidian-crystal' => 'Obsidian Crystal',
                                'luxe-gold' => 'Luxe Gold Glass',
                                'rose-quartz' => 'Rose Quartz',
                            ])
                            ->default('frost-sapphire'),

                        Textarea::make('custom_css')
                            ->label('Student Custom @theme Color Palette Code')
                            ->placeholder("@theme {\n  /* Hex */\n  --color-gold-50: #fff5e9;\n  --color-gold-500: #b08516;\n  --color-gold-950: #1b1201;\n\n  /* OKLCH */\n  --color-brand-500: oklch(0.65 0.15 240);\n\n  /* HSL */\n  --color-ocean-500: hsl(200, 80%, 50%);\n\n  /* RGB */\n  --color-coral-500: rgb(255, 127, 80);\n}")
                            ->helperText('Paste any custom @theme block with 50-950 color palette scales. Supports Hex, OKLCH, HSL, RGB formats. Applied to Student Portal!')
                            ->rows(8),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('active_theme')
                    ->label('Student Theme')
                    ->badge()
                    ->color('info')
                    ->formatStateUsing(fn ($state) => match ($state) {
                        'custom' => 'Custom Palette',
                        default => ucfirst((string) $state),
                    }),
                Tables\Columns\TextColumn::make('admin_theme')
                    ->label('Admin Skeuo Theme')
                    ->badge()
                    ->color('success')
                    ->formatStateUsing(fn ($state) => ucfirst(str_replace('-', ' ', (string) $state))),
                Tables\Columns\TextColumn::make('custom_css')
                    ->label('Custom Palette')
                    ->formatStateUsing(fn ($state) => ! empty($state) ? '✅ Active' : '—')
                    ->badge()
                    ->color(fn ($state) => ! empty($state) ? 'success' : 'gray'),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime('d M Y H:i'),
            ])
            ->actions([
                EditAction::make()->label('Configure Theme'),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPortalSettings::route('/'),
            'edit' => Pages\EditPortalSetting::route('/{record}/edit'),
        ];
    }
}
