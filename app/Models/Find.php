<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Find extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_sender',
        'id_reciever',
    ];

    protected $table = 'find';

    public function sender()
    {
        return $this->belongsTo(user::class, 'id_sender');
    }
    public function reciever()
    {
        return $this->belongsTo(user::class, 'id_reciever');
    }
}
