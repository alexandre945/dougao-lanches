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
        Schema::table('order_lists', function (Blueprint $table) {
            $table->foreignId('address_user_types_id')
                  ->after('id')
                  ->constrained('address_user_types')
                  ->onDelete('cascade'); // Opcional: adiciona comportamento de exclusão em cascata
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('order_lists', function (Blueprint $table) {
            $table->dropForeign(['address_user_types_id']);
            $table->dropColumn('address_user_types_id');
        });
    }
};
