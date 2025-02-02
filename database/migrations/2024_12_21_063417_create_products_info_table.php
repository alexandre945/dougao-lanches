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
        Schema::create('products_info', function (Blueprint $table) {
            $table->id();
            $table->boolean('payment')->default(0)->nullable(); // 0 = cartão, 1 = dinheiro
            $table->boolean('delivery')->default(0)->nullable(); // 0 = retirar, 1 = entregar
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relaciona com usuários
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products_info');
    }
};
