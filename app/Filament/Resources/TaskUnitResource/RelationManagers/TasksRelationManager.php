<?php

namespace App\Filament\Resources\TaskUnitResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Resources\{Form, Table};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Tables\Filters\MultiSelectFilter;
use Filament\Resources\RelationManagers\HasManyRelationManager;

class TasksRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'tasks';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                TextInput::make('name')
                    ->rules(['required', 'max:255', 'string'])
                    ->placeholder('Name')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                BelongsToSelect::make('job_id')
                    ->rules(['required', 'exists:jobs,id'])
                    ->relationship('job', 'name')
                    ->searchable()
                    ->placeholder('Job')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                DatePicker::make('start_date')
                    ->rules(['required', 'date'])
                    ->placeholder('Start Date')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                DatePicker::make('delivery_date')
                    ->rules(['required', 'date'])
                    ->placeholder('Delivery Date')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                BelongsToSelect::make('task_type_id')
                    ->rules(['required', 'exists:task_types,id'])
                    ->relationship('taskType', 'name')
                    ->searchable()
                    ->placeholder('Task Type')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                BelongsToSelect::make('subject_matter_id')
                    ->rules(['required', 'exists:subject_matters,id'])
                    ->relationship('subjectMatter', 'name')
                    ->searchable()
                    ->placeholder('Subject Matter')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                BelongsToSelect::make('translator_id')
                    ->rules(['required', 'exists:translators,id'])
                    ->relationship('translator', 'name')
                    ->searchable()
                    ->placeholder('Translator')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                TextInput::make('amount')
                    ->rules(['required', 'numeric'])
                    ->numeric()
                    ->placeholder('Amount')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                Select::make('is_paid')
                    ->rules(['required', 'in:paid,not paid,waived cost'])
                    ->searchable()
                    ->options([
                        'Paid' => 'Paid',
                        'Not Paid' => 'Not paid',
                        'Waived Cost' => 'Waived cost',
                    ])
                    ->placeholder('Is Paid')
                    ->default('Not paid')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                Select::make('status')
                    ->rules([
                        'required',
                        'in:not started,in progress,completed',
                    ])
                    ->searchable()
                    ->options([
                        'Not Started' => 'Not started',
                        'In Progress' => 'In progress',
                        'Completed' => 'Completed',
                    ])
                    ->placeholder('Status')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                RichEditor::make('notes')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('Notes')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->limit(50),
                Tables\Columns\TextColumn::make('job.name')->limit(50),
                Tables\Columns\TextColumn::make('start_date')->date(),
                Tables\Columns\TextColumn::make('delivery_date')->date(),
                Tables\Columns\TextColumn::make('taskType.name')->limit(50),
                Tables\Columns\TextColumn::make('taskUnit.name')->limit(50),
                Tables\Columns\TextColumn::make('subjectMatter.name')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('translator.name')->limit(50),
                Tables\Columns\TextColumn::make('amount'),
                Tables\Columns\TextColumn::make('is_paid')->enum([
                    'Paid' => 'Paid',
                    'Not Paid' => 'Not paid',
                    'Waived Cost' => 'Waived cost',
                ]),
                Tables\Columns\TextColumn::make('status')->enum([
                    'Not Started' => 'Not started',
                    'In Progress' => 'In progress',
                    'Completed' => 'Completed',
                ]),
                Tables\Columns\TextColumn::make('notes')->limit(50),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(
                                    Builder $query,
                                    $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '>=',
                                    $date
                                )
                            )
                            ->when(
                                $data['created_until'],
                                fn(
                                    Builder $query,
                                    $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '<=',
                                    $date
                                )
                            );
                    }),

                MultiSelectFilter::make('job_id')->relationship('job', 'name'),

                MultiSelectFilter::make('task_type_id')->relationship(
                    'taskType',
                    'name'
                ),

                MultiSelectFilter::make('task_unit_id')->relationship(
                    'taskUnit',
                    'name'
                ),

                MultiSelectFilter::make('subject_matter_id')->relationship(
                    'subjectMatter',
                    'name'
                ),

                MultiSelectFilter::make('translator_id')->relationship(
                    'translator',
                    'name'
                ),
            ]);
    }
}
