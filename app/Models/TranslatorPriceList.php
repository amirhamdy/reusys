<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TranslatorPriceList extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'task_type_id',
        'source_language_id',
        'target_language_id',
        'subject_matter_id',
        'currency_id',
        'task_unit_id',
        'translator_id',
        'unit_price',
        'minimum_charge',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'translator_price_lists';

    public function taskType()
    {
        return $this->belongsTo(TaskType::class);
    }

    public function targetLanguage()
    {
        return $this->belongsTo(Language::class, 'target_language_id');
    }

    public function sourceLanguage()
    {
        return $this->belongsTo(Language::class, 'source_language_id');
    }

    public function subjectMatter()
    {
        return $this->belongsTo(SubjectMatter::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function taskUnit()
    {
        return $this->belongsTo(TaskUnit::class);
    }

    public function translator()
    {
        return $this->belongsTo(Translator::class);
    }
}
