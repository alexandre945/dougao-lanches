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
        Schema::create('manual_admin_carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('additional_id')->nullable();
            $table->text('observation')->nullable();
            $table->integer('quantity')->default(1);
            $table->decimal('total',10,2)->default(0);
            $table->boolean('delivery_type')->default(0); // 0 para retirar, 1 para entregar
            $table->boolean('payment_type')->default(0); // 0 para dinheiro, 1 para cartão
            $table->decimal('unit_price',10,2);
            $table->timestamps();
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('additional_id')->references('id')->on( 'additionals')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manual_admin_carts');
    }
};
