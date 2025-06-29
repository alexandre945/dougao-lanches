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
        Schema::create('manual_carts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('client_name');
            $table->string('phone')->nullable();
            $table->enum('order_type', ['retirar', 'entregar']);
            $table->string('street')->nullable();
            $table->string('district')->nullable();
            $table->string('number')->nullable();
            $table->string('reference')->nullable();

            // Produto
            $table->unsignedInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedInteger('additional_id');
            $table->foreign('additional_id')->references('id')->on('additionals')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 8, 2);
            $table->decimal('total_price', 8, 2);

            // Observação
            $table->text('observation')->nullable();

            // Status do pedido no carrinho (aberto ou fechado)
            $table->enum('status', ['aberto', 'fechado'])->default('aberto');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('manual_carts');
    }
};
