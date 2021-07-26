<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Igaster\LaravelCities\Geo;

class City extends Model
{
    use HasFactory, Geo;

    protected $fillable = [
        'name',
        'alternames',
        'country',
        'id',
        'level',
        'population',
        'lat',
        'long',
    ];

}

