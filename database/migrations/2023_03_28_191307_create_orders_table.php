<!-- <?php

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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->onDelete('cascade');
            $table->decimal('total');
            $table->string('rejection_reason')->nullable();
            $table->enum('status',['processando','aceito','produção','pronto','recusado','saiu para emtrega','entregue'])->dafault('processando');
            $table->foreignId('additional_id')->nullable();
            $table->double('delivery_fee')->default('6');
            $table->boolean('payment');
            $table->boolean('delivery');
            $table->double('quantity');
            $table->string('observation')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
