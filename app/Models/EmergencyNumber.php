<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmergencyNumber extends Model
{
    protected $table = 'emergency_numbers';

    protected $fillable = [
        'name',
        'number',
        'order',
    ];
}
