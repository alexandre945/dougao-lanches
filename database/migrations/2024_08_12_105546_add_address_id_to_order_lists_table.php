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
    //         $table->unsignedBigInteger('address_id')->nullable()->after('id');
    //         $table->foreign('address_id')->references('id')->on('addresses');
    //     });
    // }

    // /**
    //  * Reverse the migrations.
    //  */
    // public function down(): void
    // {
    //     Schema::table('order_lists', function (Blueprint $table) {
    //         $table->unsignedInteger('address_id')->nullable()->after('id');
    //         $table->foreign('address_id')->references('id')->on('addresses');
    //     });
    // }
};
