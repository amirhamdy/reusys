<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceJob extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'amount',
        'cost',
        'cost_usd',
        'invoice_id',
        'job_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'invoice_jobs';

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function job()
    {
        return $this->belongsTo(Job::class);
    }
}
