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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->after('id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->after('user_id');
            $table->foreign('product_id')->references('id')->on('productos')->onDelete('cascade');
            $table->dropForeign(['cart_id']);
            $table->dropColumn('cart_id');
        });
    }
    
    public function down()
    {
        Schema::table('cart_items', function (Blueprint $table) {
            $table->unsignedBigInteger('cart_id')->after('id');
            $table->foreign('cart_id')->references('id')->on('carts')->onDelete('cascade');
            $table->dropForeign(['user_id', 'product_id']);
            $table->dropColumn('user_id', 'product_id');
        });
    }
    
};
