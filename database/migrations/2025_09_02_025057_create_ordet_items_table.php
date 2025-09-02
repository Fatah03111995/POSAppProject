<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ordet_items', function (Blueprint $table) {
            $table->id();

            //Order ID (Foreign Key)
            $table->unsignedBigInteger('OrderId');
            $table->foreign('OrderId')->references('id')->on('orders')->onDelete('cascade');

            //Product ID (Foreign Key)
            $table->unsignedBigInteger('ProductId');
            $table->foreign('ProductId')->references('id')->on('products')->onDelete('cascade');

            // Quantitiy
            $table->integer('Quantity');

            //Price
            $table->decimal('Price', 8, 2);


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ordet_items');
    }
};
