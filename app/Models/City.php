<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'parent_id',
        'left',
        'right',
        'depth',
        'name',
        'alternames',
        'country',
        'a1code',
        'level',
        'population',
        'lat',
        'long',
        'timezone'
    ];

    protected $table = 'geo';
}
