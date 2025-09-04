<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'total_price',
    ];

    //Relation with Order
    public function order ()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    //belongsTo(Model yang menjadi relasi, foreign key di model ini)
    //belongsTo menyatakan bahwa setiap order item dimiliki oleh salah satu order
    //fungsi order() akan mengembalikan instance model Order
    //dapat digunakan untuk mengakses detail order
    //order()->name

    //Relation with Product
    public function product ()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    //belongsTo(Model yang menjadi relasi, foreign key di model ini)
    //fungsi product() akan mengembalikan instance model Product
    //dapat digunakan untuk mengakses detail product
    //product()->name atau product()->price

    //Kalkulasi subtotal
    public function subtotal()
    {
        return $this->Quantity * $this->Price;
    }
}
