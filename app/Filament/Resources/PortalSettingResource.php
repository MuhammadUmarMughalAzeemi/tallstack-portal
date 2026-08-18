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
                Section::make('⚡ Admin Panel Skeuo-Glass Theme')
                    ->description('Configure glassmorphic theme for Filament admin interface. Can also use custom palette colors.')
                    ->schema([
                        Select::make('admin_theme')
                            ->label('Admin Glassmorphism Preset')
                            ->options([
                                'custom-glass' => '✨ Custom Glass (Uses Custom Palette)',
                                'frost-sapphire' => '❄️ Frost Sapphire',
                                'emerald-glass' => '💚 Emerald Glass',
                                'obsidian-crystal' => '⚫ Obsidian Crystal',
                                'luxe-gold' => '🏆 Luxe Gold Glass',
                                'rose-quartz' => '🌸 Rose Quartz',
                            ])
                            ->default('frost-sapphire')
                            ->helperText('Select "Custom Glass" to apply your @theme colors to the admin panel with glassmorphism effects.'),
                    ])
                    ->columns(1)
                    ->collapsible(),
                Section::make('🎓 Student Portal Theme Settings')
                    ->description('Configure theme preset for candidate application forms and student dashboards.')
                    ->schema([
                        Select::make('active_theme')
                            ->label('Student Theme Preset')
                            ->options([
                                'custom' => '⚙️ Use Custom Palette (from above)',
                                'default' => '🔵 Default Blue Theme',
                            ])
                            ->default('custom')
                            ->helperText('Select "Use Custom Palette" to apply your @theme colors to the student portal.')
                            ->nullable(),
                    ])
                    ->columns(1)
                    ->collapsible(),
                Section::make('🎨 Custom @theme Color Palette (Shared - Student & Admin)')
                    ->description('Define a custom color palette that can be used across both Student Portal and Admin Panel. This palette automatically generates CSS variables for your custom colors.')
                    ->schema([
                        Textarea::make('custom_css')
                            ->label('Custom Color Palette Code')
                            ->placeholder("@theme {\n  /* Hex Format */\n  --color-brand-50: #f0f9ff;\n  --color-brand-100: #e0f2fe;\n  --color-brand-200: #bae6fd;\n  --color-brand-300: #7dd3fc;\n  --color-brand-400: #38bdf8;\n  --color-brand-500: #0ea5e9;\n  --color-brand-600: #0284c7;\n  --color-brand-700: #0369a1;\n  --color-brand-800: #075985;\n  --color-brand-900: #0c4a6e;\n  --color-brand-950: #082f49;\n\n  /* OKLCH Format */\n  --color-accent-500: oklch(0.65 0.15 240);\n\n  /* HSL Format */\n  --color-ocean-500: hsl(200, 80%, 50%);\n\n  /* RGB Format */\n  --color-coral-500: rgb(255, 127, 80);\n}")
                            ->helperText('✨ Define custom colors with 50-950 scales. Works with Hex, OKLCH, HSL, RGB. Use these colors via: text-brand-500, bg-brand-100, etc.')
                            ->rows(10)
                            ->columnSpanFull(),
                    ])
                    ->columnSpanFull()
                    ->collapsible()
                    ->collapsed(false),


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
                        'default' => 'Default Blue',
                        default => ucfirst((string) $state),
                    }),
                Tables\Columns\TextColumn::make('admin_theme')
                    ->label('Admin Theme')
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
                EditAction::make()->label('Configure Themes'),
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
