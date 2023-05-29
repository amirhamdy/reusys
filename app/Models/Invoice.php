<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'date',
        'number',
        'bank_id',
        'paid',
        'paid_date',
        'notes',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date' => 'date',
        'paid' => 'boolean',
        'paid_date' => 'date',
    ];

    public function invoiceJobs()
    {
        return $this->hasMany(InvoiceJob::class);
    }

    public function bank()
    {
        return $this->belongsTo(Bank::class);
    }

    public function job()
    {
        return $this->hasOneThrough(Job::class, InvoiceJob::class, 'invoice_id', 'id', 'id', 'job_id');
    }
}
