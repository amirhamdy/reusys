<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TaskType extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name'];

    protected $searchableFields = ['*'];

    protected $table = 'task_types';

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function translatorPriceLists()
    {
        return $this->hasMany(TranslatorPriceList::class);
    }
}
