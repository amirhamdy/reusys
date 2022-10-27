<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pricebook extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['name', 'currency_id'];

    protected $searchableFields = ['*'];

    public function productlines()
    {
        return $this->hasMany(Productline::class);
    }

    public function pricelists()
    {
        return $this->hasMany(Pricelist::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
