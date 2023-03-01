<?php

namespace App\Filament\Resources\JobResource\RelationManagers;

use App\Filament\Resources\TranslatorResource;
use App\Mail\TaskCreated;
use App\Models\Job;
use App\Models\Translator;
use App\Models\TranslatorPriceList;
use Illuminate\Support\Facades\Date;
use Closure;
use Filament\Forms;
use Illuminate\Support\Facades\Mail;
use Livewire\Component as Livewire;
use Filament\Forms\Components\Toggle;
use Filament\Notifications\Actions\Action;
use Filament\Notifications\Notification;
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
use Filament\Tables\Actions\CreateAction;

class TasksRelationManager extends HasManyRelationManager
{
    protected static string $relationship = 'tasks';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                TextInput::make('name')
                    ->rules(['required', 'max:255', 'string'])->required()
                    ->placeholder('Name')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                DatePicker::make('start_date')
                    ->rules(['required', 'date'])->required()
                    ->default(Date::now())
                    ->placeholder('Start Date')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                DatePicker::make('delivery_date')
                    ->rules(['required', 'date'])->required()
                    ->default(Date::now())
                    ->placeholder('Delivery Date')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                BelongsToSelect::make('task_type_id')
                    ->rules(['required', 'exists:task_types,id'])->required()
                    ->relationship('taskType', 'name')->preload()
                    ->searchable()->preload()
                    ->placeholder('Task Type')
                    ->afterStateUpdated(fn(Closure $set, Closure $get, Livewire $livewire) => self::calc_cost($set, $get, $livewire))->reactive()
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                BelongsToSelect::make('task_unit_id')
                    ->rules(['required', 'exists:task_units,id'])->required()
                    ->relationship('taskUnit', 'name')->preload()
                    ->searchable()->preload()
                    ->placeholder('Task Unit')
                    ->afterStateUpdated(fn(Closure $set, Closure $get, Livewire $livewire) => self::calc_cost($set, $get, $livewire))->reactive()
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                BelongsToSelect::make('subject_matter_id')
                    ->rules(['required', 'exists:subject_matters,id'])->required()
                    ->relationship('subjectMatter', 'name')->preload()
                    ->searchable()->preload()
                    ->placeholder('Subject Matter')
                    ->afterStateUpdated(fn(Closure $set, Closure $get, Livewire $livewire) => self::calc_cost($set, $get, $livewire))->reactive()
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                BelongsToSelect::make('translator_id')
                    ->label('Resource')
                    ->rules(['required', 'exists:translators,id'])->required()
                    ->relationship('translator', 'name')->preload()
                    ->searchable()->preload()
                    ->placeholder('Resource')
                    ->afterStateUpdated(fn(Closure $set, Closure $get, Livewire $livewire) => self::calc_cost($set, $get, $livewire))->reactive()
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 6]),

                TextInput::make('amount')
                    ->rules(['required', 'numeric'])->required()
                    ->numeric()
                    ->default(1)
                    ->placeholder('Amount')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4])
                    ->afterStateUpdated(fn(Closure $set, Closure $get, Livewire $livewire) => self::calc_cost($set, $get, $livewire))->reactive(),

                Select::make('is_paid')
                    ->label('Payment Status')
                    ->rules(['required', 'in:Paid,Not Paid,Waived Cost'])->required()
                    ->searchable()
                    ->options(['Paid' => 'Paid', 'Not Paid' => 'Not Paid', 'Waived Cost' => 'Waived Cost'])
                    ->placeholder('Payment Status')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                Select::make('status')
                    ->rules(['required', 'in:Not Started,In Progress,Completed',])->required()
                    ->searchable()
                    ->options(['Not Started' => 'Not Started', 'In Progress' => 'In Progress', 'Completed' => 'Completed'])
                    ->placeholder('Status')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                TextInput::make('cost')
                    ->hint('This is a calculated, not editable cost depending on your selections.')->hintColor('success')
                    ->rules(['required', 'numeric'])->required()
                    ->numeric()->disabled()
                    ->placeholder('This is a calculated not editable cost depending on your selections')
                    ->default(null)
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),

                Toggle::make('is_free_task')
                    ->label('Mark as a free task')
                    ->rules(['required', 'boolean'])->required()
                    ->afterStateUpdated(fn(Closure $set, Closure $get, Livewire $livewire) => self::calc_cost($set, $get, $livewire))->reactive()
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                Toggle::make('is_minimum_charge_used')
                    ->label('Apply minimum charge for this job')
                    ->rules(['required', 'boolean'])->required()
                    ->afterStateUpdated(fn(Closure $set, Closure $get, Livewire $livewire) => self::calc_cost($set, $get, $livewire))->reactive()
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                Toggle::make('send_po')
                    ->label('Send P.O copy to the Resource?')
                    ->rules(['boolean'])
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 4]),

                RichEditor::make('notes')
                    ->rules(['nullable', 'max:255', 'string'])
                    ->placeholder('Notes')
                    ->columnSpan(['default' => 12, 'md' => 12, 'lg' => 12]),
            ]),
        ]);
    }

    public static function calc_cost(Closure $set, Closure $get, Livewire $livewire)
    {
        $job_id = $livewire->ownerRecord->id ?? 0;
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
//                dd($job_id ,$task_type_id ,$task_unit_id , $subject_matter_id , $translator_id , $amount, $currency, $job);
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

                    Notification::make()->warning()->duration(30000)
                        ->title('No price-list found!')
                        ->actions([
                            Action::make('Open resource page')
                                ->button()
                                ->url(TranslatorResource::getUrl('view', ['record' => $translator_id]), shouldOpenInNewTab: true)
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
            ])
            ->appendActions([
                CreateAction::make()
                    ->mutateFormDataUsing(function (array $data): array {
                        $data['cost_usd'] = $data['cost'] * 20;
                        return $data;
                    })
                    ->after(function (array $data): array {
                        if ($data['send_po']) {
                            $translator = Translator::find($data['translator_id']);
                            // dd($translator->email);
                            if ($translator->email) {
                                Mail::to($translator->email)->send(new TaskCreated($translator->name));
                            }
                        }

                        return $data;
                    })
            ]);
    }
}
