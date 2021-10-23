<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->boolean('status')->default(true);
            $table->string('sku', 100)->unique();
            $table->string('title', 100);
            $table->text('small_description')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('type')->default(1);
            $table->boolean('maintain_stock')->default(true);
            $table->string('slug', 100)->unique();
            $table->string('meta_title', 100)->nullable();
            $table->string('meta_description', 170)->nullable();
            $table->string('meta_image', 191)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
