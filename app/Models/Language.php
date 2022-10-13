<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Language extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'code'];

    protected $searchableFields = ['*'];

    public function pricelists()
    {
        return $this->hasMany(Pricelist::class, 'source_language_id');
    }

    public function pricelists2()
    {
        return $this->hasMany(Pricelist::class, 'target_language_id');
    }

    public function jobs()
    {
        return $this->hasMany(Job::class, 'source_language_id');
    }

    public function jobs2()
    {
        return $this->hasMany(Job::class, 'target_language_id');
    }

    public function opportunities()
    {
        return $this->hasMany(Opportunity::class, 'source_language_id');
    }

    public function opportunities2()
    {
        return $this->hasMany(Opportunity::class, 'target_language_id');
    }

    public function translatorPriceLists()
    {
        return $this->hasMany(TranslatorPriceList::class, 'source_language_id');
    }

    public function translatorPriceLists2()
    {
        return $this->hasMany(TranslatorPriceList::class, 'target_language_id');
    }
}
