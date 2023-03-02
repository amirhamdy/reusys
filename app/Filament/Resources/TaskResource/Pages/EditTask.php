<?php

namespace App\Filament\Resources\TaskResource\Pages;

use App\Filament\Resources\TaskResource;
use App\Mail\SendNotificationEmail;
use App\Mail\TaskCreated;
use App\Models\Translator;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class EditTask extends EditRecord
{
    protected static string $resource = TaskResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['cost_usd'] = $data['cost'] * 20;
        return $data;
    }

    protected function afterSave(): void
    {
        $po = $this->record->job->project->po_number;
        $user = auth()->user();

        if ($this->data['send_po']) {
            $translator = Translator::find($this->data['translator_id']);
//            $res = Mail::to('amirhamdy4@gmail.com')->send(new TaskCreated($translator->name, Str::random(10) /*$this->data['po_number'*/));
            if ($translator->email) {
                Mail::to($translator->email)->send(new TaskCreated($translator->name, $po));
            }
        }

        Mail::to($user->email)->send(new TaskCreated($user->name, $po));

        Mail::send(new SendNotificationEmail($this->record, 'updated', 'task'));
    }

}
