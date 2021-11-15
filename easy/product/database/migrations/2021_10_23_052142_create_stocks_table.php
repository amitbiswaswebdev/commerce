<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity');
            $table->foreignId('product_id');
            $table->foreignId('source_id');
            $table->timestamps();
        });
        Schema::table('inventories', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->constrained()->onDelete('cascade');
            $table->foreign('source_id')->references('id')->on('sources')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
