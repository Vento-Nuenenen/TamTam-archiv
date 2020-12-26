<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $table = 'items';

    protected $fillable = [
        'item_name',
        'item_price',
        'item_barcode',
    ];
}
