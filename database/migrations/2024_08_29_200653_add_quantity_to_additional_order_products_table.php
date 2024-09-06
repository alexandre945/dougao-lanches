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
        Schema::table('additional_order_products', function (Blueprint $table) {
            $table->integer('quantity')->unsigned()->after('id')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('additional_order_products', function (Blueprint $table) {
            $table->dropColumn('quantity');
        });
    }
};