<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
        //'transaction_number',
        // 'cashier_id',
        // 'total_price',
        // 'total_items',
        // 'payment_method',
    public function store(Request $request)
    {
        $orderData = $request->validate(
            [
                'cashier_id' => 'required',
                'items'=> 'required|array',
                'items.*.product_id' => 'required|exists:products,id',
                //* wild card -> jika items.0 artinya hanya index 0
                //. untuk nested data
                //items.*.product_id -> product_id pada setiap item
                //required, harus ada
                //exists:products,id -> harus ada di tabel producks, kolom id
                'items.*.quantity' => 'required|integer',
            ]
            );

        //Create Order
        $order = \App\Models\Order::create(
            // fungsi create menerima array associative
            // digunakan untuk membuat record baru di Database tabel Orders
            [
                'transaction_number' => 'TRX-'.strtoupper(uniqid()),
                'cashier_id' => $orderData['cashier_id'],
                'total_price' => collect(
                    $orderData['items']
                )->sum(function($item){
                    $product =\App\Models\Product::find($item['product_id']);
                    return $product->price * $item['quantity'];
                }),
                'total_items' => collect($orderData['items'])->sum('quantity'),
                'payment_method' => $request->input('payment_method', 'cash')
            ]
                );

            foreach($orderData['items'] as $item){
                $order->orderItems()->create(
                    [
                        'product_id' => $item['product_id'],
                        'quantity' => $item['quantity'],
                        'price' => \App\Models\Product::find($item['product_id'])->price,
                    ]
                );
            }
            // Loop setiap item

            return response()->json([
                'message'=>'Order created successfully',
                'data' => $order->load('items','cashier')
            ],201);
    }
}
