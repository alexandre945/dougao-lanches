<!-- <?php

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// return new class extends Migration
// {
//     /**
//      * Run the migrations.
//      */
//     public function up(): void
//     {
//         Schema::create('address_user_types', function (Blueprint $table) {
//             $table->id();
//             $table->foreignId('user_id')->constrained()->onDelete('cascade');
//             $table->foreignId('address_id')->constrained()->onDelete('cascade');
//             $table->foreignId('address_type_id')->constrained()->onDelete('cascade');
//             $table->timestamps();
//         });
//     }

//     /**
//      * Reverse the migrations.
//      */
//     public function down(): void
//     {
//         Schema::dropIfExists('address_user_types');
//     }
// };

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressUserTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
     {
        Schema::create('address_user_types', function (Blueprint $table) {
             $table->id();
             $table->unsignedBigInteger('user_id');
             $table->foreignId('address_id')->constrained();
             $table->foreignId('address_type_id')->constrained();
             $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');

         });
     }

    // /**
    //  * Reverse the migrations.
    //  *
    //  * @return void
    //  */
     public function down()
     {
        Schema::dropIfExists('address_user_types');
    }
}
