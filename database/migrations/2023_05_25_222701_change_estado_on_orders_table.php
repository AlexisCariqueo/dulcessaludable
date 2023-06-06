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
        DB::statement("ALTER TABLE orders MODIFY COLUMN estado ENUM('pendiente', 'pagado', 'enviando', 'entregado')");
    }
    

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        DB::statement("ALTER TABLE orders MODIFY COLUMN estado ENUM('pendiente', 'procesando', 'enviando', 'entregado')");
    }
    
};
