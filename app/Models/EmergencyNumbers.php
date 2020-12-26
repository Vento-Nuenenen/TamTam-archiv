<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmergencyNumbers extends Model
{
    protected $table = 'emergency_numbers';

    protected $fillable = [
        'name',
        'number',
        'order',
    ];
}
