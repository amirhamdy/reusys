<?php

namespace App\Filament\Resources\TaskResource\Pages;

use App\Filament\Resources\TaskResource;
use App\Mail\SendNotificationEmail;
use App\Mail\TaskCreated;
use App\Models\Translator;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class CreateTask extends CreateRecord
{
    protected static string $resource = TaskResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['cost_usd'] = $data['cost'] * 20;
        return $data;
    }

    protected function afterCreate(): void
    {
        $user = auth()->user();
        $po = $this->record->job->project->po_number;

        $job = $this->record->job;

        if ($this->data['send_po']) {
            $translator = Translator::find($this->data['translator_id']);
            if ($translator->emails) {
                $emails = explode(',', $translator->emails);
                foreach ($emails as $email) {
                    Mail::to($email)->send(new TaskCreated($translator->name, $po));
                }
            }
        }

        Mail::to($user->email)->send(new TaskCreated($user->name, $po));

        Mail::send(new SendNotificationEmail($this->record, 'created', 'task'));
    }
}
