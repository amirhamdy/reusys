<?php

namespace App\Filament\Resources\JobResource\Pages;

use App\Filament\Resources\JobResource;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditJob extends EditRecord
{
    protected static string $resource = JobResource::class;

//    protected function mutateFormDataBeforeSave(array $data): array
//    {
//        if ($data['is_free_job']) {
//            $data['cost'] = 0;
//        } else {
//            $project_id = $data['project_id'];
//            $project = Project::where('id', $project_id)->first();
//            $productline = Productline::where('id', $project->productline_id)->first();
//
//            $pricelist = Pricelist::where('job_type_id', $data['job_type_id'])
//                ->where('job_unit_id', $data['job_unit_id'])
//                ->where('source_language_id', $data['source_language_id'])
//                ->where('target_language_id', $data['target_language_id'])
//                ->where('pricebook_id', $productline->pricebook_id)
//                ->first();
//
//            if ($pricelist && $pricelist['unit_price']) {
//                if ($data['is_minimum_charge_used']) {
//                    $data['cost'] = $pricelist['minimum_charge'];
//                } else {
//                    $unit_price = $pricelist['unit_price'];
//                    $data['cost'] = $data['amount'] * $unit_price;
//                }
//            } else {
//                unset($data['cost']);
//            }
//        }
//
//        return $data;
//    }
//
//    protected function beforeSave(): void
//    {
//        if (!$this->data['is_free_job']) {
//            if (!isset($this->data['cost'])) {
//                Notification::make()
//                    ->warning()
//                    ->title('You don\'t have an active subscription!')
//                    ->body('Choose a plan to continue.')
//                    ->persistent()
//                    ->send();
//
//                $this->halt();
//            }
//        }
//    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->title('Saved successfully!')
            ->body('The job has been updated successfully.')
            ->icon('heroicon-o-document-text')
            ->iconColor('success')
            ->send();
    }
}
