<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'fax',
        'website',
        'address',
        'postal_code',
        'city',
        'billing_address',
        'country_id',
        'region_id',
        'industry_id',
        'customer_rating_id',
        'customer_status_id',
    ];

    protected $searchableFields = ['*'];

    public function customerStatus()
    {
        return $this->belongsTo(CustomerStatus::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function customerRating()
    {
        return $this->belongsTo(CustomerRating::class);
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }

    public function productlines()
    {
        return $this->hasMany(Productline::class);
    }
}
