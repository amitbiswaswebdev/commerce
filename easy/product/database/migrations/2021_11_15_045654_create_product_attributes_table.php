<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_attributes', function (Blueprint $table) {
            $table->id();
            $table->string('code', 100)->unique()->index();
            $table->string('level', 100);
            $table->string('input', 100);
            $table->json('validation_rules')->nullable();
            $table->boolean('user_defined')->default(true);
            $table->string('default_value', 100)->nullable();
            $table->json('model_value')->nullable(); //(options) like dorp down, radio, checkbox
            // front end properties
            $table->boolean('show_in_frontend')->default(true);
            $table->boolean('use_in_filter')->default(false);
            // $table->string('show_as', 100)->nullable();
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
        Schema::dropIfExists('product_attributes');
    }
}
