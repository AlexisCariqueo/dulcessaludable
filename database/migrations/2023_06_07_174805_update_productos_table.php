<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateProductosTable extends Migration
{
    public function up()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->integer('precio')->unsigned()->change();
        });
    }

    public function down()
    {
        Schema::table('productos', function (Blueprint $table) {
            $table->decimal('precio', 8, 2)->unsigned()->change();
        });
    }
}
