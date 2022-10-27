<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Productline extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = ['name', 'pricebook_id', 'customer_id'];

    protected $searchableFields = ['*'];

    public function pricebook()
    {
        return $this->belongsTo(Pricebook::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function opportunities()
    {
        return $this->hasMany(Opportunity::class);
    }
}
