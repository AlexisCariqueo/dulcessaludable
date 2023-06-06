<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameProductIdToProductosIdInOrderItemsTable extends Migration
{
    public function up()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->renameColumn('producto_id', 'productos_id');
        });
    }

    public function down()
    {
        Schema::table('order_items', function (Blueprint $table) {
            $table->renameColumn('productos_id', 'producto_id');
        });
    }
}