<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JobType extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name'];

    protected $searchableFields = ['*'];

    protected $table = 'job_types';

    public function pricelists()
    {
        return $this->hasMany(Pricelist::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
