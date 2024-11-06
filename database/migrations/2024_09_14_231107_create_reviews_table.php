<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('reviews', function (Blueprint $table) {
    //         $table->id();
    //         $table->unsignedBigInteger('user_id');
    //         $table->unsignedBigInteger('orders_id');
    //         $table->text('comment')->nullable();
    //         $table->integer('rating');
    //         $table->timestamps();
    //          // Chave estrangeira para a tabela orders
    //          $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
    //          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    //     });
    // }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
