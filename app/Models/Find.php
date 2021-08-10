<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Find extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_sender',
        'isFriend',
        'id_reciever',
        'match'
    ];

    protected $table = 'find';

    public function sender()
    {
        return $this->belongsTo(users::class, 'id_sender');
    }
    public function reciever()
    {
        return $this->belongsTo(users::class, 'id_reciever');
    }
}
