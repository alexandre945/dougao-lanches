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
        Schema::create('order_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id');
            $table->foreignId('product_id');
            $table->foreignId('additional_id')->nullable();
            $table->foreignId('blind_carts_id')->nullable();
            $table->unsignedBigInteger('address_user_types_id');
            $table->foreignId('address_type_id')->nullable()->constrained('address_types');
            $table->foreignId('address_id')->nullable();
            $table->string('observation')->nullable();
            $table->integer('quamtity');
            $table->double('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::table('order_lists', function (Blueprint $table) {
            $table->dropForeign(['address_user_types_id']);
            $table->dropColumn('address_user_types_id'); // Nome do campo que contém a FK
        });

        Schema::dropIfExists('order_lists');
    }
};
