<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyNumber extends Model
{
    use HasFactory;

    protected $table = 'emergency_numbers';

    protected $fillable = [
        'name',
        'number',
        'order',
    ];
}
