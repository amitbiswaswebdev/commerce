<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity')->default(1);
            $table->double('base_price', 8, 4)->default(0000.0000);
            $table->double('special_price', 8, 4)->nullable()->default(0000.0000);
            $table->date('offer_start')->nullable();
            $table->date('offer_end')->nullable();
            $table->foreignId('product_id');
            $table->timestamps();
        });
        Schema::table('prices', function (Blueprint $table) {
            $table->foreign('product_id')->references('id')->on('products')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prices');
    }
}
