<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameProductIdToProductosIdInImagenProductosTable extends Migration
{
    public function up()
    {
        Schema::table('imagen_productos', function (Blueprint $table) {
            $table->renameColumn('producto_id', 'productos_id');
        });
    }

    public function down()
    {
        Schema::table('imagen_productos', function (Blueprint $table) {
            $table->renameColumn('productos_id', 'producto_id');
        });
    }
}
