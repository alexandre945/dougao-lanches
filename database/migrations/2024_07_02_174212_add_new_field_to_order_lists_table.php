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
    //     Schema::table('order_lists', function (Blueprint $table) {
    //         $table->unsignedBigInteger('address_user_types_id')
    //               ->after('id'); // Adiciona a coluna após o campo 'id'

    //         // Adiciona a chave estrangeira
    //         $table->foreign('address_user_types_id')
    //               ->references('id')
    //               ->on('address_user_types')
    //               ->onDelete('cascade'); // Opcional: adiciona comportamento de exclusão em cascata
    //     });
    // }

    // /**
    //  * Reverse the migrations.
    //  */
    // public function down(): void
    // {
    //     Schema::table('order_lists', function (Blueprint $table) {
    //            // Remove a chave estrangeira
    //            $table->dropForeign(['address_user_types_id']);

    //            // Remove a coluna
    //            $table->dropColumn('address_user_types_id');
    //     });
    // }
};
