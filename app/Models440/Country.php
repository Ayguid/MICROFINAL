<?php

namespace App\Models440;

use Illuminate\Database\Eloquent\Model;
use App\Models440\Product_In_Country;
use App\Models440\Product;



class Country extends Model
{
    //
    protected $table= 'countries';

    protected $fillable = [
    'country_desc', 'locale_key', 'default_lang', 'country_shortcode', 'telephone'
    ];

}
