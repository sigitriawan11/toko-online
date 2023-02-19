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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('order_id');
            $table->string('product_code');
            $table->foreign('product_code')->references('product_code')->on('products');
            $table->string('name');
            $table->string('phone');
            $table->string('province');
            $table->string('city');
            $table->text('address');
            $table->string('token');
            $table->integer('qty');
            $table->double('total_price');
            $table->string('status')->default('Pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
