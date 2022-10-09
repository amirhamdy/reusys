<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'code'];

    protected $searchableFields = ['*'];

    public function pricebooks()
    {
        return $this->hasMany(Pricebook::class);
    }

    public function translators()
    {
        return $this->hasMany(Translator::class);
    }

    public function translatorPriceLists()
    {
        return $this->hasMany(TranslatorPriceList::class);
    }
}
