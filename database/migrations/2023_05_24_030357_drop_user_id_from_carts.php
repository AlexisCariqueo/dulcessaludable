<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('carts', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign('carts_user_id_foreign');
    
            // Drop unique index
            $table->dropIndex('carts_user_id_foreign');
    
            // Drop the column
            $table->dropColumn('user_id');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('carts', function (Blueprint $table) {
            //
        });
    }
};
