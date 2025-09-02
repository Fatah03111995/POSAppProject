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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            //Transaction Time
            $table->timestamp('transaction_time');

            //transaction number
            $table->string('transaction_number')->unique();

            //User_ID (foreign key)
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
                    ->references('id')
                     ->on('users')
                    ->onDelete('set null');
                    //onDelete('cascade') means if user is deleted, all their orders are deleted
                    //onDelete('set null') means if user is deleted, user_id in orders is set to null

                    //Total Price
            $table->decimal('total_price', 10, 2);
            //decimal(name, total digits, digits after decimal)
            //decimal use for money values

            //Total Items
            $table->integer('total_items')->default(0);

            //Payment Method
            $table->string('payment_method')->default('cash');
            //Status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
