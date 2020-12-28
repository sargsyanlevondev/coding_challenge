<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'purchase';

    protected $fillable = [
        'customer_name',
        'title',
        'quantity',
        'price',
        'total',
        'offering_id',
    ];
}
