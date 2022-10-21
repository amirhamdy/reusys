<?php

namespace App\Filament\Resources\JobResource\Widgets;

use App\Filament\Resources\JobResource;
use App\Models\Currency;
use App\Models\Job;
use Closure;
use Filament\Tables;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestJobs extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    protected static ?int $sort = 2;

    public function getDefaultTableRecordsPerPageSelectOption(): int
    {
        return 5;
    }

    protected function getDefaultTableSortColumn(): ?string
    {
        return 'created_at';
    }

    protected function getDefaultTableSortDirection(): ?string
    {
        return 'desc';
    }

    protected function getTableQuery(): Builder
    {
        return JobResource::getEloquentQuery();
    }

    protected function getTableColumns(): array
    {
        return [
            Tables\Columns\TextColumn::make('created_at')
                ->label('Job Date')
                ->date()
                ->sortable(),
            Tables\Columns\TextColumn::make('name')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('sourceLanguage.name')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('targetLanguage.name')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('jobType.name')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('amount')
                ->searchable()
                ->sortable(),
            Tables\Columns\TextColumn::make('jobUnit.name')
                ->searchable()
                ->sortable(),
            Tables\Columns\BadgeColumn::make('amount')
                ->colors([
                    'danger' => fn($amount) => $amount < 10,
                    'warning' => fn($amount) => $amount >= 10 && $amount < 100,
                    'success' => fn($amount) => $amount > 100,
                ]),
        ];
    }

    protected function getTableActions(): array
    {
        return [
            Tables\Actions\Action::make('view')
                ->url(fn(Job $record): string => JobResource::getUrl('view', ['record' => $record])),
        ];
    }
}
