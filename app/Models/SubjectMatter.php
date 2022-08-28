<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubjectMatter extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name'];

    protected $searchableFields = ['*'];

    protected $table = 'subject_matters';

    public function pricelists()
    {
        return $this->hasMany(Pricelist::class);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
