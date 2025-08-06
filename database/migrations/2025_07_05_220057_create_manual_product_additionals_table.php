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
    Schema::create('manual_product_additionals', function (Blueprint $table) {
        $table->id();
        $table->unsignedInteger('manual_additional_id')->nullable(); // Renomeado
        $table->unsignedBigInteger('manual_admin_cart_id')->nullable(); // Referência ao carrinho
        $table->integer('quantity')->default(1); // Quantidade do adicional

        $table->timestamps();

        $table->foreign('manual_additional_id')->references('id')->on('additionals')->onDelete('cascade');
        $table->foreign('manual_admin_cart_id')->references('id')->on('manual_admin_carts')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manual_product_additionals');
    }
};
