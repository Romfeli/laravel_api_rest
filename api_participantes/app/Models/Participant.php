<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;
    protected $table = 'participant';

    protected $fillable = [
        'dni',
        'name_and_last_name',
        'email',
        'phone_number',

    ];

}
