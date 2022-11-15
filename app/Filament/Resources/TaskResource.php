<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Models\Customer;
use App\Models\Job;
use App\Models\Productline;
use App\Models\Project;
use App\Models\Task;
use App\Models\TranslatorPriceList;
use Closure;
use Filament\{Forms\Components\Toggle, Notifications\Actions\Action, Notifications\Notification, Tables};
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\{Form, Resource, Table};
use Filament\Tables\Filters\MultiSelectFilter;
use Illuminate\Database\Eloquent\Collection;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $navigationGroup = 'Tasks';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('name')
                        ->rules(['required', 'max:255', 'string'])
                        ->placeholder('Name')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                    BelongsToSelect::make('customer_id')
                        ->hiddenOn(['view', 'edit'])
                        ->rules(['required', 'exists:customers,id'])
                        ->options(Customer::all()->pluck('name', 'id'))->preload()
                        ->searchable()->disablePlaceholderSelection()
                        ->placeholder('Customer')->label('Customer')
                        ->afterStateUpdated(fn(callable $set) => $set('productline_id', null))->reactive()
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                    BelongsToSelect::make('productline_id')
                        ->hiddenOn(['view', 'edit'])
                        ->rules(['required', 'exists:productlines,id'])
                        ->options(function (callable $get) {
                            $customer = Customer::find($get('customer_id'));
                            if ($customer) return $customer->productlines->pluck('name', 'id');
                            return [];
                        })->preload()
                        ->searchable()
                        ->placeholder('Productline')->label('Productline')
                        ->afterStateUpdated(fn(callable $set) => $set('project_id', null))->reactive()
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                    BelongsToSelect::make('project_id')
                        ->hiddenOn(['view', 'edit'])
                        ->rules(['required', 'exists:projects,id'])
                        ->options(function (callable $get) {
                            $productline = Productline::find($get('productline_id'));
                            if ($productline) return $productline->projects->pluck('name', 'id');
                            return [];
                        })->preload()
                        ->searchable()->reactive()
                        ->placeholder('Project')->label('Project')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4])
                        ->afterStateUpdated(fn(Closure $set, Closure $get) => self::calc_cost($set, $get)),

                    BelongsToSelect::make('job_id')
                        ->hiddenOn(['view', 'edit'])
                        ->rules(['required', 'exists:jobs,id'])
                        ->options(function (callable $get) {
                            $project = Project::find($get('project_id'));
                            if ($project) return $project->jobs->pluck('name', 'id');
                            return [];
                        })->preload()
                        ->searchable()->preload()
                        ->placeholder('Job')->label('Job')
                        ->afterStateUpdated(fn(Closure $set, Closure $get) => self::calc_cost($set, $get))->reactive()
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                    DatePicker::make('start_date')
                        ->rules(['required', 'date'])
                        ->placeholder('Start Date')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                    DatePicker::make('delivery_date')
                        ->rules(['required', 'date'])
                        ->placeholder('Delivery Date')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                    BelongsToSelect::make('task_type_id')
                        ->rules(['required', 'exists:task_types,id'])
                        ->relationship('taskType', 'name')->preload()
                        ->searchable()->preload()
                        ->placeholder('Task Type')
                        ->afterStateUpdated(fn(Closure $set, Closure $get) => self::calc_cost($set, $get))->reactive()
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                    BelongsToSelect::make('task_unit_id')
                        ->rules(['required', 'exists:task_units,id'])
                        ->relationship('taskUnit', 'name')->preload()
                        ->searchable()->preload()
                        ->placeholder('Task Unit')
                        ->afterStateUpdated(fn(Closure $set, Closure $get) => self::calc_cost($set, $get))->reactive()
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                    BelongsToSelect::make('subject_matter_id')
                        ->rules(['required', 'exists:subject_matters,id'])
                        ->relationship('subjectMatter', 'name')->preload()
                        ->searchable()->preload()
                        ->placeholder('Subject Matter')
                        ->afterStateUpdated(fn(Closure $set, Closure $get) => self::calc_cost($set, $get))->reactive()
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                    BelongsToSelect::make('translator_id')
                        ->label('Resource')
                        ->rules(['required', 'exists:translators,id'])
                        ->relationship('translator', 'name')->preload()
                        ->searchable()->preload()
                        ->placeholder('Resource')
                        ->afterStateUpdated(fn(Closure $set, Closure $get) => self::calc_cost($set, $get))->reactive()
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                    TextInput::make('amount')
                        ->rules(['required', 'numeric'])
                        ->numeric()
                        ->placeholder('Amount')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4])
                        ->afterStateUpdated(fn(Closure $set, Closure $get) => self::calc_cost($set, $get))->reactive(),

                    Select::make('is_paid')
                        ->label('Payment Status')
                        ->rules(['required', 'in:Paid,Not Paid,Waived Cost'])
                        ->searchable()
                        ->options(['Paid' => 'Paid', 'Not Paid' => 'Not Paid', 'Waived Cost' => 'Waived Cost'])
                        ->placeholder('Payment Status')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                    Select::make('status')
                        ->rules(['required', 'in:Not Started,In Progress,Completed',])
                        ->searchable()
                        ->options(['Not Started' => 'Not Started', 'In Progress' => 'In Progress', 'Completed' => 'Completed'])
                        ->placeholder('Status')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                    TextInput::make('cost')
                        ->hint('This is a calculated not editable cost depending on your selections.')
                        ->rules(['required', 'numeric'])
                        ->numeric()->disabled()
                        ->placeholder('This is a calculated not editable cost depending on your selections')
                        ->default(null)
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                    Toggle::make('is_free_task')
                        ->label('Mark as a free task')
                        ->rules(['required', 'boolean'])
                        ->afterStateUpdated(fn(Closure $set, Closure $get) => self::calc_cost($set, $get))->reactive()
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                    Toggle::make('is_minimum_charge_used')
                        ->label('Apply minimum charge for this job')
                        ->rules(['required', 'boolean'])
                        ->afterStateUpdated(fn(Closure $set, Closure $get) => self::calc_cost($set, $get))->reactive()
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                    RichEditor::make('notes')
                        ->rules(['nullable', 'max:255', 'string'])
                        ->placeholder('Notes')
                        ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),
                ]),
            ]),
        ]);
    }

    public static function calc_cost(Closure $set, Closure $get)
    {
        $job_id = $get('job_id') ?? 0;
        $task_type_id = $get('task_type_id') ?? 0;
        $task_unit_id = $get('task_unit_id') ?? 0;
        $subject_matter_id = $get('subject_matter_id') ?? 0;
        $translator_id = $get('translator_id') ?? 0;
        $is_minimum_charge_used = $get('is_minimum_charge_used');
        $is_free_task = $get('is_free_task');
        $amount = (int)$get('amount') ?? 0;

        if ($job_id && $task_type_id && $task_unit_id && $subject_matter_id && $translator_id && $amount) {
            if ($is_free_task) {
                $cost = 0;
                $set('is_minimum_charge_used', false);
            } else {
                $job = Job::where('id', $job_id)->first();
                $currency = $job->project->productline->pricebook->currency;

                if (!$job) {
                    Notification::make()->warning()->title('Invalid job selected!')->body('Please select a valid job to continue.')->send();
                }

                $pricelist = TranslatorPriceList::where('task_type_id', $task_type_id)
                    ->where('task_unit_id', $task_unit_id)
                    ->where('subject_matter_id', $subject_matter_id)
                    ->where('source_language_id', $job->source_language_id)
                    ->where('target_language_id', $job->target_language_id)
                    ->where('currency_id', $currency->id)
                    ->where('translator_id', $translator_id)
                    ->first();

                if ($pricelist && isset($pricelist['unit_price'])) {
                    if ($is_minimum_charge_used) {
                        $cost = $pricelist['minimum_charge'];
                        $set('is_free_task', false);
                    } else {
                        $unit_price = $pricelist['unit_price'];
                        $cost = $amount * $unit_price;
                    }
                } else {
                    $cost = null;

                    Notification::make()->warning()
                        ->title('No price-list found!')
                        ->body('Please check the selected resource and make sure he has a valid price-list to continue.')
                        ->actions([
                            Action::make('Open resource page')
                                ->button()
                                ->url("/dashboard/resources/$translator_id", shouldOpenInNewTab: true)
                        ])
                        ->send();
                }
            }
        }

        $set('cost', $cost ?? null);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')->sortable()->searchable()->label('ID')->toggleable(),
                Tables\Columns\TextColumn::make('name')->limit(30)->searchable()->sortable(),
                Tables\Columns\TextColumn::make('job.name')->limit(20)->searchable()->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('start_date')->date()->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('delivery_date')->date()->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('taskType.name')->limit(30)->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('taskUnit.name')->limit(30)->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('subjectMatter.name')->limit(30)->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('translator.name')->limit(30)->label('Resource')->searchable()->sortable()->toggleable(),
                Tables\Columns\TextColumn::make('amount')->toggleable(),
                Tables\Columns\BadgeColumn::make('is_paid')->enum([
                    'Paid' => 'Paid',
                    'Not Paid' => 'Not paid',
                    'Waived Cost' => 'Waived cost',
                ])->colors([
                    'success' => 'Paid',
                    'danger' => 'Not Paid',
                    'warning' => 'Waived Cost',
                ])->label('Payment Status')->searchable()->sortable()->toggleable(),
                Tables\Columns\BadgeColumn::make('status')->enum([
                    'Not Started' => 'Not started',
                    'In Progress' => 'In progress',
                    'Completed' => 'Completed',
                ])->colors([
                    'danger' => 'Not Started',
                    'warning' => 'In Progress',
                    'success' => 'Completed',
                ])->searchable()->sortable()->toggleable(),
            ])
            ->filters([
                MultiSelectFilter::make('job_id')
                    ->relationship('job', 'name')
                    ->label('Job'),

                MultiSelectFilter::make('task_type_id')
                    ->relationship('taskType', 'name')
                    ->label('Taks Type'),

                MultiSelectFilter::make('task_unit_id')
                    ->relationship('taskUnit', 'name')
                    ->label('Task Unit'),

                MultiSelectFilter::make('translator_id')->relationship(
                    'translator',
                    'name'
                )->label('Resource'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\Action::make('markAsPaid')
                        ->label('Mark as Paid')->color('success')
                        ->requiresConfirmation()
                        ->modalHeading('Mark Task as Paid')
                        ->modalSubheading('Are you sure you\'d like to mark this task as paid?')
                        ->modalButton('Yes')
                        ->icon('heroicon-s-pencil')
                        ->action(function (Task $record): void {
                            $record->is_paid = 'Paid';
                            $record->save();
                        })
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkAction::make('delete')
                    ->action(fn(Collection $records) => $records->each->delete())
                    ->deselectRecordsAfterCompletion()
                    ->requiresConfirmation()
                    ->color('danger')
                    ->icon('heroicon-o-trash')
                    ->modalHeading('Delete Tasks')
                    ->modalSubheading('Are you sure you\'d like to delete these tasks? This can\'t be undone.')
                    ->modalButton('Yes, Delete'),
                Tables\Actions\BulkAction::make('markAsPaid')
                    ->label('Mark as Paid')->color('success')
                    ->deselectRecordsAfterCompletion()
                    ->requiresConfirmation()
                    ->icon('heroicon-s-pencil')
                    ->modalHeading('Mark Task as Paid')
                    ->modalSubheading('Are you sure you\'d like to mark this task as paid?')
                    ->modalButton('Yes')
                    ->action(function (Collection $records): void {
                        foreach ($records as $record) {
                            $record->is_paid = 'Paid';
                            $record->save();
                        }
                    })
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            'create' => Pages\CreateTask::route('/create'),
            'view' => Pages\ViewTask::route('/{record}'),
            'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }

//    public function openMarkPaidModal(): void
//    {
//        $this->dispatchBrowserEvent('open-mark-paid-modal');
//    }

    //    protected static function getNavigationBadge(): ?string
//    {
//        return static::getModel()::count();
//    }
}
