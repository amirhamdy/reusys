<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'position',
        'translator_id',
    ];

    protected $searchableFields = ['*'];

    public function translator()
    {
        return $this->belongsTo(Translator::class);
    }
}
