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
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Resources\{Form, Resource, Table};
use Filament\Tables\Filters\MultiSelectFilter;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Date;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationIcon = 'heroicon-s-calculator';

    protected static ?string $navigationGroup = 'Tasks';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Group::make()
                    ->schema([
                        Section::make('Customer and Productline')
                            ->schema([
                                BelongsToSelect::make('customer_id')
                                    ->hiddenOn(['view', 'edit'])
                                    ->rules(['required', 'exists:customers,id'])->required()
                                    ->options(Customer::all()->where('customer_status_id', '3')->pluck('name', 'id'))->preload()
                                    ->searchable()->disablePlaceholderSelection()
                                    ->placeholder('Customer')->label('Customer')
                                    ->afterStateUpdated(fn(callable $set) => $set('productline_id', null))->reactive(),
//                                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                                BelongsToSelect::make('productline_id')
                                    ->hiddenOn(['view', 'edit'])
                                    ->rules(['required', 'exists:productlines,id'])->required()
                                    ->options(function (callable $get) {
                                        $customer = Customer::find($get('customer_id'));
                                        if ($customer) return $customer->productlines->pluck('name', 'id');
                                        return [];
                                    })->preload()
                                    ->searchable()
                                    ->placeholder('Productline')->label('Productline')
                                    ->afterStateUpdated(fn(callable $set) => $set('project_id', null))->reactive(),

                                BelongsToSelect::make('project_id')
                                    ->hiddenOn(['view', 'edit'])
                                    ->rules(['required', 'exists:projects,id'])->required()
                                    ->options(function (callable $get) {
                                        $productline = Productline::find($get('productline_id'));
                                        if ($productline) return $productline->projects->pluck('name', 'id');
                                        return [];
                                    })->preload()
                                    ->searchable()->reactive()
                                    ->placeholder('Project')->label('Project')
                                    ->afterStateUpdated(fn(Closure $set, Closure $get) => self::calc_cost($set, $get)),

                                BelongsToSelect::make('job_id')
                                    ->hiddenOn(['view', 'edit'])
                                    ->rules(['required', 'exists:jobs,id'])->required()
                                    ->options(function (callable $get) {
                                        $project = Project::find($get('project_id'));
                                        if ($project) return $project->jobs->pluck('name', 'id');
                                        return [];
                                    })->preload()
                                    ->searchable()->preload()
                                    ->placeholder('Job')->label('Job')
                                    ->afterStateUpdated(fn(Closure $set, Closure $get) => self::calc_cost($set, $get))->reactive(),
                            ])
                            ->hiddenOn(['view', 'edit'])
                            ->columns(2),

                        Section::make('Task Details')
                            ->schema([
                                BelongsToSelect::make('task_type_id')
                                    ->rules(['required', 'exists:task_types,id'])->required()
                                    ->relationship('taskType', 'name')->preload()
                                    ->searchable()->preload()
                                    ->placeholder('Task Type')
                                    ->afterStateUpdated(fn(Closure $set, Closure $get) => self::calc_cost($set, $get))->reactive(),

                                BelongsToSelect::make('task_unit_id')
                                    ->rules(['required', 'exists:task_units,id'])->required()
                                    ->relationship('taskUnit', 'name')->preload()
                                    ->searchable()->preload()
                                    ->placeholder('Task Unit')
                                    ->afterStateUpdated(fn(Closure $set, Closure $get) => self::calc_cost($set, $get))->reactive(),

                                BelongsToSelect::make('subject_matter_id')
                                    ->rules(['required', 'exists:subject_matters,id'])->required()
                                    ->relationship('subjectMatter', 'name')->preload()
                                    ->searchable()->preload()
                                    ->placeholder('Subject Matter')
                                    ->afterStateUpdated(fn(Closure $set, Closure $get) => self::calc_cost($set, $get))->reactive(),

                                BelongsToSelect::make('translator_id')
                                    ->label('Resource')
                                    ->rules(['required', 'exists:translators,id'])->required()
                                    ->relationship('translator', 'name')->preload()
                                    ->searchable()->preload()
                                    ->placeholder('Resource')
                                    ->afterStateUpdated(fn(Closure $set, Closure $get) => self::calc_cost($set, $get))->reactive(),
                            ])
                            ->columns(2),

                        Section::make('Pricing')
                            ->schema([
                                TextInput::make('amount')
                                    ->rules(['required', 'numeric'])->required()
                                    ->numeric()
                                    ->placeholder('Amount')
                                    ->default(1)
                                    ->afterStateUpdated(fn(Closure $set, Closure $get) => self::calc_cost($set, $get))->reactive(),

                                TextInput::make('cost')
                                    ->rules(['required', 'numeric'])->required()
                                    ->numeric()
                                    ->placeholder('Calculated Cost')
                                    ->default(null),

                                TextInput::make('job_currency')
                                    ->disabled()
                                    ->placeholder('This is currency of the job')
                                    ->hiddenOn(['view', 'edit'])
                                    ->default(null),

                                TextInput::make('resource_currency')
                                    ->disabled()
                                    ->placeholder('This is currency of the resource in the price list')
                                    ->hiddenOn(['view', 'edit'])
                                    ->default(null),
                            ])
                            ->columns(2),

                        Section::make('Notes')
                            ->schema([
                                RichEditor::make('notes')
                                    ->rules(['nullable', 'max:255', 'string'])
                                    ->placeholder('Notes')
                                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),
                            ])
                            ->collapsible()
                            ->collapsed(true)
                            ->columns(2),
                    ])
                    ->columnSpan(['lg' => 2]),

                Group::make()
                    ->schema([
                        Section::make('Delivery Details')
                            ->schema([
                                TextInput::make('name')
                                    ->rules(['required', 'max:255', 'string'])->required()
                                    ->placeholder('Name'),

                                DatePicker::make('start_date')
                                    ->rules(['required', 'date'])->required()
                                    ->default(Date::now())
                                    ->placeholder('Start Date'),

                                DatePicker::make('delivery_date')
                                    ->rules(['required', 'date'])->required()
                                    ->default(Date::now())
                                    ->placeholder('Delivery Date'),
                            ]),

                        Section::make('Status')
                            ->schema([
                                Select::make('is_paid')
                                    ->label('Payment Status')
                                    ->rules(['required', 'in:Paid,Not Paid,Waived Cost'])->required()
                                    ->searchable()
                                    ->options(['Paid' => 'Paid', 'Not Paid' => 'Not Paid', 'Waived Cost' => 'Waived Cost'])
                                    ->placeholder('Payment Status'),

                                Select::make('status')
                                    ->label('Task Status')
                                    ->rules(['required', 'in:Not Started,In Progress,Completed',])->required()
                                    ->searchable()
                                    ->options(['Not Started' => 'Not Started', 'In Progress' => 'In Progress', 'Completed' => 'Completed'])
                                    ->placeholder('Status'),
                            ]),

                        Section::make('Associations')
                            ->schema([
                                Toggle::make('is_free_task')
                                    ->label('Mark as a free task')
                                    ->rules(['required', 'boolean'])->required()
                                    ->afterStateUpdated(fn(Closure $set, Closure $get) => self::calc_cost($set, $get))->reactive(),

                                Toggle::make('is_minimum_charge_used')
                                    ->label('Apply minimum charge for this job')
                                    ->rules(['required', 'boolean'])->required()
                                    ->afterStateUpdated(fn(Closure $set, Closure $get) => self::calc_cost($set, $get))->reactive(),

                                Toggle::make('send_po')
                                    ->label('Send P.O copy to the Resource?')
                                    ->rules(['boolean'])
                                    ->default(true),
                            ]),
                    ])
                    ->columnSpan(['lg' => 1]),
            ])
            ->columns(3);
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

                // set job currency
                $set('job_currency', $currency->name);

                $pricelist = TranslatorPriceList::where('task_type_id', $task_type_id)
                    ->where('task_unit_id', $task_unit_id)
                    ->where('subject_matter_id', $subject_matter_id)
                    ->where('source_language_id', $job->source_language_id)
                    ->where('target_language_id', $job->target_language_id)
//                    ->where('currency_id', $currency->id)
                    ->where('translator_id', $translator_id)
                    ->first();

                if ($pricelist && isset($pricelist['unit_price'])) {
                    // set resource currency
                    $set('resource_currency', $pricelist->currency->name);

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
//                        ->body('Please check the selected resource and make sure he has a valid price-list to continue.')
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
                TextColumn::make('id')->sortable()->searchable()->label('Task ID')->searchable(),
                TextColumn::make('name')->limit(30)->searchable()->sortable()->disableClick(),
                TextColumn::make('job.name')->limit(20)->searchable()->toggleable()->disableClick(),
                TextColumn::make('job.project.name')->limit(20)->searchable()->toggleable()->disableClick(),
                TextColumn::make('job.project.productline.name')->limit(20)->searchable()->toggleable()->disableClick(),
                TextColumn::make('job.project.productline.customer.name')->limit(20)->searchable()->toggleable()->disableClick(),
                TextColumn::make('job.project.productline.pricebook.name')->limit(20)->searchable()->toggleable()->disableClick(),
                TextColumn::make('job.project.productline.pricebook.currency.name')->limit(20)->searchable()->toggleable()->disableClick(),
                TextColumn::make('start_date')->date()->sortable()->toggleable()->disableClick(),
                TextColumn::make('delivery_date')->date()->sortable()->toggleable()->disableClick(),
                TextColumn::make('taskType.name')->limit(30)->sortable()->toggleable()->disableClick(),
                TextColumn::make('taskUnit.name')->limit(30)->sortable()->toggleable()->disableClick(),
                TextColumn::make('subjectMatter.name')->limit(30)->sortable()->toggleable()->disableClick(),
                TextColumn::make('translator.name')->limit(30)->label('Resource')->searchable()->sortable()->toggleable()->disableClick(),
                TextColumn::make('amount')->toggleable()->disableClick(),
                TextColumn::make('cost')->toggleable()->disableClick(),
                BadgeColumn::make('is_paid')->enum([
                    'Paid' => 'Paid',
                    'Not Paid' => 'Not paid',
                    'Waived Cost' => 'Waived cost',
                ])->colors([
                    'success' => 'Paid',
                    'danger' => 'Not Paid',
                    'warning' => 'Waived Cost',
                ])->label('Payment Status')->searchable()->sortable()->toggleable()->disableClick(),
                BadgeColumn::make('status')->enum([
                    'Not Started' => 'Not started',
                    'In Progress' => 'In progress',
                    'Completed' => 'Completed',
                ])->colors([
                    'danger' => 'Not Started',
                    'warning' => 'In Progress',
                    'success' => 'Completed',
                ])->searchable()->sortable()->toggleable()->disableClick(),
            ])->defaultSort('id', 'desc')
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
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make(),
                    Action::make('markAsPaid')
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
                BulkAction::make('delete')
                    ->action(fn(Collection $records) => $records->each->delete())
                    ->deselectRecordsAfterCompletion()
                    ->requiresConfirmation()
                    ->color('danger')
                    ->icon('heroicon-o-trash')
                    ->modalHeading('Delete Tasks')
                    ->modalSubheading('Are you sure you\'d like to delete these task? This can\'t be undone.')
                    ->modalButton('Yes, Delete'),
                BulkAction::make('markAsPaid')
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
}
