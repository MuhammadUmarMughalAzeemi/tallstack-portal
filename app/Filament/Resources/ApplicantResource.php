<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ApplicantResource\Pages;
use App\Models\User;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Infolists\Components as InfolistComponents;
use Filament\Resources\Resource;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class ApplicantResource extends Resource
{
    protected static ?string $model = User::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-academic-cap';

    protected static ?string $navigationLabel = 'Applicants';

    protected static ?string $modelLabel = 'Applicant';

    protected static ?string $pluralModelLabel = 'Applicants';

    protected static ?int $navigationSort = 1;

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->whereNotNull('submitted_at');
    }

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Review & Status')
                    ->components([
                        Select::make('status')
                            ->label('Application Review Status')
                            ->options([
                                1 => 'Approved',
                                2 => 'Pending / Under Review',
                                3 => 'Rejected',
                            ])
                            ->required(),
                        Toggle::make('is_paid')
                            ->label('Fee Payment Verified')
                            ->onColor('success')
                            ->offColor('danger'),
                        Textarea::make('comments')
                            ->label('Admin Remarks / Verification Comments')
                            ->rows(3),
                    ])->columns(1),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('App #')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->label('Candidate Name')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('cnic_passport')
                    ->label('CNIC / Passport')
                    ->searchable(),
                Tables\Columns\TextColumn::make('mobile_number')
                    ->label('Mobile')
                    ->searchable()
                    ->toggleable(),
                Tables\Columns\TextColumn::make('program.name')
                    ->label('Program')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('submitted_at')
                    ->label('Submitted')
                    ->dateTime('d M Y H:i')
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_paid')
                    ->label('Fee Paid')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger')
                    ->action(
                        Action::make('togglePayment')
                            ->label('Toggle Payment')
                            ->requiresConfirmation()
                            ->action(function (User $record) {
                                $record->update(['is_paid' => ! $record->is_paid]);
                            })
                    ),
                Tables\Columns\TextColumn::make('status')
                    ->label('Review Status')
                    ->badge()
                    ->formatStateUsing(fn ($state) => match ((int) $state) {
                        1 => 'Approved',
                        2 => 'Pending',
                        3 => 'Rejected',
                        default => 'Unknown',
                    })
                    ->color(fn ($state) => match ((int) $state) {
                        1 => 'success',
                        2 => 'warning',
                        3 => 'danger',
                        default => 'gray',
                    }),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Review Status')
                    ->options([
                        1 => 'Approved',
                        2 => 'Pending',
                        3 => 'Rejected',
                    ]),
                Tables\Filters\TernaryFilter::make('is_paid')
                    ->label('Fee Paid'),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make()->label('Review'),
                Action::make('approve')
                    ->label('Approve')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(fn (User $record) => $record->update(['status' => 1]))
                    ->visible(fn (User $record) => (int) $record->status !== 1),
                Action::make('reject')
                    ->label('Reject')
                    ->icon('heroicon-o-x-circle')
                    ->color('danger')
                    ->requiresConfirmation()
                    ->action(fn (User $record) => $record->update(['status' => 3]))
                    ->visible(fn (User $record) => (int) $record->status !== 3),
            ])
            ->bulkActions([
                BulkActionGroup::make([
                    BulkAction::make('approveSelected')
                        ->label('Approve Selected')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->requiresConfirmation()
                        ->action(fn ($records) => $records->each->update(['status' => 1])),
                    BulkAction::make('markPaid')
                        ->label('Mark Fee Paid')
                        ->icon('heroicon-o-banknotes')
                        ->color('info')
                        ->requiresConfirmation()
                        ->action(fn ($records) => $records->each->update(['is_paid' => true])),
                ]),
            ])
            ->defaultSort('submitted_at', 'desc');
    }

    public static function infolist(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Personal Information')
                    ->components([
                        InfolistComponents\TextEntry::make('name')->label('Full Name'),
                        InfolistComponents\TextEntry::make('father_name')->label("Father's Name"),
                        InfolistComponents\TextEntry::make('email')->label('Email'),
                        InfolistComponents\TextEntry::make('mobile_number')->label('Mobile Number'),
                        InfolistComponents\TextEntry::make('cnic_passport')->label('CNIC / Passport'),
                        InfolistComponents\TextEntry::make('pmdc_pnmc')->label('PMDC / PNMC No'),
                        InfolistComponents\TextEntry::make('personalDetails.date_of_birth')->label('Date of Birth'),
                        InfolistComponents\TextEntry::make('personalDetails.mother_name')->label("Mother's Name"),
                    ])->columns(3),

                Section::make('Academic Qualifications')
                    ->components([
                        InfolistComponents\TextEntry::make('qualifications.ssc_marks_obtained')->label('SSC Marks Obtained'),
                        InfolistComponents\TextEntry::make('qualifications.ssc_total_marks')->label('SSC Total Marks'),
                        InfolistComponents\TextEntry::make('qualifications.hssc_marks_obtained')->label('HSSC Marks Obtained'),
                        InfolistComponents\TextEntry::make('qualifications.hssc_total_marks')->label('HSSC Total Marks'),
                        InfolistComponents\TextEntry::make('qualifications.mbbs_marks_obtained')->label('Bachelor Marks Obtained'),
                        InfolistComponents\TextEntry::make('qualifications.mbbs_total_marks')->label('Bachelor Total Marks'),
                        InfolistComponents\TextEntry::make('qualifications.mphil_marks_obtained')->label('M.Phil Marks Obtained'),
                        InfolistComponents\TextEntry::make('qualifications.mphil_total_marks')->label('M.Phil Total Marks'),
                    ])->columns(4),

                Section::make('Entry Test & Program')
                    ->components([
                        InfolistComponents\TextEntry::make('admissionTest.md_cat_obtained_marks')->label('MDCAT Marks'),
                        InfolistComponents\TextEntry::make('admissionTest.md_cat_total_marks')->label('MDCAT Total'),
                        InfolistComponents\TextEntry::make('program.name')->label('Selected Program'),
                        InfolistComponents\TextEntry::make('aggregate')->label('Aggregate Score'),
                    ])->columns(4),

                Section::make('Review Status')
                    ->components([
                        InfolistComponents\TextEntry::make('status')
                            ->label('Review Status')
                            ->badge()
                            ->formatStateUsing(fn ($state) => match ((int) $state) {
                                1 => 'Approved',
                                2 => 'Pending',
                                3 => 'Rejected',
                                default => 'Unknown',
                            })
                            ->color(fn ($state) => match ((int) $state) {
                                1 => 'success',
                                2 => 'warning',
                                3 => 'danger',
                                default => 'gray',
                            }),
                        InfolistComponents\IconEntry::make('is_paid')
                            ->label('Fee Paid')
                            ->boolean(),
                        InfolistComponents\TextEntry::make('comments')->label('Admin Comments'),
                        InfolistComponents\TextEntry::make('submitted_at')
                            ->label('Submitted At')
                            ->dateTime('d M Y H:i'),
                    ])->columns(2),
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListApplicants::route('/'),
            'edit' => Pages\EditApplicant::route('/{record}/edit'),
            'view' => Pages\ViewApplicant::route('/{record}'),
        ];
    }
}
