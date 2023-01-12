<?php

namespace App\Filament\Resources\TaskResource\Pages;

use App\Filament\Resources\TaskResource;
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
        if ($this->data['send_po']) {
            $translator = Translator::find($this->data['translator_id']);
            if ($translator->email) {
                Mail::to($translator->email)->send(new TaskCreated($translator->name,  Str::random(15)));
            }
        }
    }
}
