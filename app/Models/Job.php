<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'amount',
        'is_free_job',
        'is_minimum_charge_used',
        'project_id',
        'source_language_id',
        'target_language_id',
        'job_type_id',
        'job_unit_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'is_free_job' => 'boolean',
        'is_minimum_charge_used' => 'boolean',
    ];

    public function sourceLanguage()
    {
        return $this->belongsTo(Language::class, 'source_language_id');
    }

    public function targetLanguage()
    {
        return $this->belongsTo(Language::class, 'target_language_id');
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class);
    }

    public function jobUnit()
    {
        return $this->belongsTo(JobUnit::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
