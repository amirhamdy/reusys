<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Translator extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'degree',
        'gender',
        'date_of_birth',
        'nationality',
        'experience',
        'id_number',
        'vat_number',
        'id_other',
        'timezone',
        'website',
        'skype',
        'address',
        'city',
        'postal_code',
        'payment_after',
        'nda',
        'cv',
        'native_language',
        'second_language',
        'translator_type_id',
        'country_id',
        'currency_id',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date_of_birth' => 'date',
        'nda' => 'boolean',
        'cv' => 'boolean',
    ];

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function translatorType()
    {
        return $this->belongsTo(TranslatorType::class);
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function translatorPriceLists()
    {
        return $this->hasMany(TranslatorPriceList::class);
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
