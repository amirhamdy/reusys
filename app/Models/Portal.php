<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Portal extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'url', 'username', 'password'];

    protected $searchableFields = ['*'];

    protected $hidden = ['password'];
}
