<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    protected $table = 'participations';

    protected $fillable = [
        'scout_name',
        'first_name',
        'last_name',
        'address',
        'plz',
        'place',
        'birthday',
        'gender',
        'person_picture',
        'barcode',
        'seat_number',
        'course_passed',
        'FK_GRP',
        ];
}
