<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use Carbon\Carbon;
use Filament\Forms\Components\DatePicker;
use Filament\Pages\Actions\ReplicateAction;
use Illuminate\Database\Eloquent\Model;

//use Barryvdh\DomPDF\Facade\Pdf;
use Spatie\Browsershot\Browsershot;
use App\Models\Invoice;
use Filament\Pages\Actions\Action;
use Filament\Pages\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\InvoiceResource;

class ViewInvoice extends ViewRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function getActions(): array
    {
        return [
            EditAction::make(),
            Action::make('pdf')
                ->label('Download PDF')
                ->icon('heroicon-o-document-download')
                ->color('success')
                ->action('generateInvoicePDF'),
//            ReplicateAction::make()->button()->color('warning')
//                ->form([
//                    DatePicker::make('invoice_date')->required()
//                ])
//                ->beforeReplicaSaved(function (Model $replica, array $data): void {
//                    $replica->invoice_date = $data['invoice_date'];
//                }),
        ];
    }

    public function generateInvoicePDF()
    {
        $invoice = Invoice::find($this->record->id);
        $content = view('pdf.invoice', ['invoice' => $invoice])->render();

        $date = Carbon::parse($invoice->date)->toFormattedDateString();

        $content = str_replace('---i_number---', $invoice->number, $content);
        $content = str_replace('---i_date---', $date, $content);

        $content = $this->replace_customer_tags($content, $invoice);
        $content = $this->replace_project_tags($content, $invoice);
        $content = $this->replace_payment_tags($content, $invoice);
        $content = $this->replace_bank_tags($content, $invoice);

        return response()->stream(function () use ($invoice, $content) {
            $browsershot = (new Browsershot)
                ->setNodeBinary('/usr/bin/node')
                ->setNpmBinary('/usr/bin/npm')
                ->setNodeModulePath("/var/www/reusys/node_modules/");

            echo $browsershot->html($content)
                ->initialPageNumber(1)
                ->showBrowserHeaderAndFooter()
                ->footerHtml('<p>Page <span class="pageNumber"></span> of <span class="totalPages"></span></p>')
                ->pdf();
        }, 200, ['Content-Type' => 'application/pdf', 'Content-Disposition' => 'attachment; filename="invoice_' . $invoice->number . '.pdf"']);
    }

    private function replace_customer_tags($content, $invoice)
    {
        if ($invoice->invoiceJobs->first()->job->project->productline->customer->name)
            $content = str_replace('---c_name---', $invoice->invoiceJobs->first()->job->project->productline->customer->name . '<br>', $content);
        else
            $content = str_replace('---c_name---', '', $content);
        if ($invoice->invoiceJobs->first()->job->project->productline->customer->name)
            $content = str_replace('---c_email---', $invoice->invoiceJobs->first()->job->project->productline->customer->email . '<br>', $content);
        else
            $content = str_replace('---c_email---', '', $content);
        if ($invoice->invoiceJobs->first()->job->project->productline->customer->address)
            $content = str_replace('---c_address---', $invoice->invoiceJobs->first()->job->project->productline->customer->address . '<br>', $content);
        else
            $content = str_replace('---c_address---', '', $content);
        if ($invoice->invoiceJobs->first()->job->project->productline->customer->phone)
            $content = str_replace('---c_phone---', $invoice->invoiceJobs->first()->job->project->productline->customer->phone . '<br>', $content);
        else
            $content = str_replace('---c_phone---', '', $content);
        if ($invoice->invoiceJobs->first()->job->project->productline->customer->city)
            $content = str_replace('---c_city---', $invoice->invoiceJobs->first()->job->project->productline->customer->city . '<br>', $content);
        else
            $content = str_replace('---c_city---', '', $content);
        if ($invoice->invoiceJobs->first()->job->project->productline->customer->country)
            $content = str_replace('---c_country---', $invoice->invoiceJobs->first()->job->project->productline->customer->country->name . '<br>', $content);
        else
            $content = str_replace('---c_country---', '', $content);

        return $content;
    }

    private function replace_project_tags($content, $invoice)
    {
        $content = str_replace('---p_name---', $invoice->invoiceJobs->first()->job->project->name . '<br>', $content);
        $content = str_replace('---p_po---', $invoice->invoiceJobs->first()->job->project->po_number . '<br>', $content);

        $p_source = '';
        $p_target = '';

        foreach ($invoice->invoiceJobs as $invoiceJob) {
            $p_source .= $invoiceJob->job->sourceLanguage->name . ' - ';
            $p_target .= $invoiceJob->job->targetLanguage->name . ' - ';
        }

        $content = str_replace('---p_source---', $p_source . '<br>', $content);
        $content = str_replace('---p_target---', $p_target . '<br>', $content);

        return $content;
    }

    private function replace_payment_tags($content, $invoice)
    {
        $content = str_replace('---j_type---', $invoice->invoiceJobs->first()->job->jobUnit->name, $content);

        $amount = 0;
        $total = 0;

        foreach ($invoice->invoiceJobs as $invoiceJob) {
            $amount += $invoiceJob->job->amount;
            $total += $invoiceJob->job->cost;
        }

        $content = str_replace('---j_amount---', $amount, $content);
        $content = str_replace('---j_total---', $total . ' ' . $invoice->invoiceJobs->first()->job->project->productline->pricebook->currency->name, $content);

        return $content;
    }

    private function replace_bank_tags($content, $invoice)
    {
        $content = str_replace('---b_name---', $invoice->bank->name, $content);
        $content = str_replace('---b_account---', $invoice->bank->account_name, $content);
        $content = str_replace('---b_number---', $invoice->bank->account_number, $content);
        $content = str_replace('---b_swift---', $invoice->bank->routing_number, $content);
        $content = str_replace('---b_country---', $invoice->bank->country->name, $content);

        return $content;
    }


}
