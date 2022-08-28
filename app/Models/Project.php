<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'start_date',
        'end_date',
        'po_number',
        'productline_id',
        'currency_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function productline()
    {
        return $this->belongsTo(Productline::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
