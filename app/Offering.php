<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Offering extends Model
{
    protected $table = 'offering';

    protected $casts = [
        'quantity'=>'integer',
        'price'=>'integer'
    ];
}
