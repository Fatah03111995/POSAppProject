<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable =[
        'transaction_time',
        'transaction_number',
        'user_id',
        'total_price',
        'total_items',
        'payment_method',

    ];
}
