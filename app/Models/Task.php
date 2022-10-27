<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'start_date',
        'delivery_date',
        'status',
        'amount',
        'is_paid',
        'cost',
        'payment_date',
        'notes',
        'job_id',
        'task_type_id',
        'task_unit_id',
        'subject_matter_id',
        'translator_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'start_date' => 'date',
        'delivery_date' => 'date',
        'payment_date' => 'date',
    ];

    public function job()
    {
        return $this->belongsTo(Job::class);
    }

    public function taskType()
    {
        return $this->belongsTo(TaskType::class);
    }

    public function taskUnit()
    {
        return $this->belongsTo(TaskUnit::class);
    }

    public function subjectMatter()
    {
        return $this->belongsTo(SubjectMatter::class);
    }

    public function translator()
    {
        return $this->belongsTo(Translator::class);
    }
}
