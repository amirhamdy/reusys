<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pricelist extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'subject_matter_id',
        'job_type_id',
        'job_unit_id',
        'source_language_id',
        'target_language_id',
        'pricebook_id',
        'unit_price',
        'minimum_charge',
    ];

    protected $searchableFields = ['*'];

    public function subjectMatter()
    {
        return $this->belongsTo(SubjectMatter::class);
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class);
    }

    public function jobUnit()
    {
        return $this->belongsTo(JobUnit::class);
    }

    public function pricebook()
    {
        return $this->belongsTo(Pricebook::class);
    }

    public function sourceLanguage()
    {
        return $this->belongsTo(Language::class, 'source_language_id');
    }

    public function targetLanguage()
    {
        return $this->belongsTo(Language::class, 'target_language_id');
    }
}
