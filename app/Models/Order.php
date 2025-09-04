<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable =[
        'transaction_number',
        'cashier_id',
        'total_price',
        'total_items',
        'payment_method',

    ];

    public function orderItems()
    {
        return $this->hasMany(\App\Models\OrderItem::class);
    }

    //Relationship with User (Cashier)
    public function cashier ()
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }
    //belongsTo(Model yang menjadi relasi, foreign key di model ini)
    //belongsTo menyatakan bahwa setiap order dimiliki oleh salah satu user (Cashier)
    //fungsi cashier() akan mengembalikan instance model User
    //dapat digunakan untuk mengakses detail cashier
    //cashier()->name atau cashier()->email

}
