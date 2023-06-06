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
        Schema::table('productos', function (Blueprint $table) {
            $table->unsignedBigInteger('categorias_id')->nullable(); // Asegúrate de que la columna sea nullable si es necesario
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->dropColumn('categorias_id');
        });
    }
    
};
