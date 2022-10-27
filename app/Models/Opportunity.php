<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Opportunity extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'date',
        'description',
        'amount',
        'price',
        'probability_to_win',
        'status',
        'productline_id',
        'source_language_id',
        'target_language_id',
        'opportunity_type_id',
        'opportunity_unit_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date' => 'date',
    ];

    public function productline()
    {
        return $this->belongsTo(Productline::class);
    }

    public function sourceLanguage()
    {
        return $this->belongsTo(Language::class, 'source_language_id');
    }

    public function targetLanguage()
    {
        return $this->belongsTo(Language::class, 'target_language_id');
    }

    public function opportunityType()
    {
        return $this->belongsTo(OpportunityType::class);
    }

    public function opportunityUnit()
    {
        return $this->belongsTo(OpportunityUnit::class);
    }
}
